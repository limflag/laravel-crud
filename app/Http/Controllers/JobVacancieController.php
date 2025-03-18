<?php

namespace App\Http\Controllers;

use App\Models\JobVacancie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobVacancieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search     = $request->input('search');
        $type       = $request->input('type');
        $paused     = $request->input('paused');
        $applied    = $request->input('applied');
        $orderBy    = $request->input('order_by', 'created_at');
        $orderDir   = $request->input('order_dir', 'desc');

        $query = JobVacancie::query();
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($type) {
            $query->where('type', $type);
        }
        if (!is_null($paused)) {
            $query->where('paused', $paused);
        }
        if (Auth::check() && $applied) {
            $userId = Auth::id();
            if ($applied === 'inscritas') {
                $query->whereHas('applications', function ($q) use ($userId) {
                    $q->where('user_id', $userId);
                });
            } elseif ($applied === 'nao_inscritas') {
                $query->whereDoesntHave('applications', function ($q) use ($userId) {
                    $q->where('user_id', $userId);
                });
            }
        }
        $query->orderBy($orderBy, $orderDir);
        $jobVacancies = $query->paginate(20)->appends($request->query());
        return view('index', compact('jobVacancies', 'search', 'type', 'paused', 'applied', 'orderBy', 'orderDir'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!auth()->user()->isAdmin) {
            return redirect()->route('jobs.index')->with('error', 'Você não tem permissão para tal ação');
        }
        return view('job-vacancies.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!auth()->user()->isAdmin) {
            return redirect()->route('jobs.index')->with('error', 'Você não tem permissão para tal ação');
        }

        $validated = $request->validate([
           'title'          => 'required|string|max:255',
           'description'    => 'required|string',
           'type'           => 'required|in:CLT,CNPJ,Freelancer',
           'paused'         => 'required|boolean'
        ]);
        $createdJob = JobVacancie::create($validated);
        return redirect()->route('jobs.show', $createdJob->id)->with('sucess', 'Vaga criada com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $job = JobVacancie::with('applications')->findOrFail($id);
        return view('job-vacancies.show', [
            'job'       => $job,
            'editMode'  => $request->query('editMode', false)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobVacancie $jobVacancie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        if (!auth()->user()->isAdmin) {
            return redirect()->route('jobs.show', $id)->with('error', 'Você não tem permissão para realizar tal ação');
        }

        $job = JobVacancie::findOrFail($id);

        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'required|string',
            'type'          => 'required|in:CLT,CNPJ,Freelancer',
            'paused'        => 'required|boolean',
        ]);

        $job->update($validated);

        return redirect()->route('jobs.show', ['id' => $id])->with('success', 'Vaga atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $job = JobVacancie::findOrFail($id);

        if (!auth()->user()->isAdmin) {
            return redirect()->route('jobs.show', $id)->with('error', 'Você não tem permissão para realizar tal ação');
        }
        $job->delete();
        return redirect()->route('index')->with('success', 'Vaga excluída com sucesso');
    }

    public function apply($id)
    {
        $job = JobVacancie::findOrFail($id);
        $user = auth()->user();

        if(!$user) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para realizar tal ação');
        }

        $application = $job->applications()->where('user_id', $user->id)->first();
        if($application) {
            $application->delete();
            return redirect()->route('jobs.show', $id)->with('sucess', 'Você cancelou sua inscrição na vaga');
        } else {
            $job->applications()->create(['user_id' => $user->id]);
            return redirect()->route('jobs.show', $id)->with('sucess', 'Inscrição realizada com sucesso');
        }
    }
}
