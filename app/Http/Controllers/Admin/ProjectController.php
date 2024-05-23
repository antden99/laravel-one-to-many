<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //dd(Project::all()); //ricordati di definire la rotta adesso in routes
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request) //quando invii il form, ricordati di andare nella cartella Request e autorizzare cambiando da false a true, altrimenti non funzionerà
    {
        //dd($request->all()); //ricorda all() 

        //per create, ricorda ri aggiungere le $fillable nel modello Project

        //valida 
        $val_date = $request->validated();
        //dd($val_date);


        //se la richiesta ha qusto campo, allora la vado a salvare nello storage e sofrascrivo il dato corretto altrimenti non lo faccio perchè non entro nell'if
        if ($request->has('cover_image')) {

            $img_path = Storage::put('uploads', $val_date['cover_image']);
            //dd($val_date, $image_path);

            //adesso devo sovrascrivere la chiave cover_image, perchè altrimenti non conterrà il percorso corretto, fai dd per controllare(fatto a riga 42)
            $val_date['cover_image'] = $img_path;
        }


        Project::create($val_date); //con create creo una nuova istanza di project e la salvo direttamente nel db ma ricorda le $fillable

        //redirect
        return to_route('admin.projects.index')->with('success', 'Project added successfully');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //dd($request->all());
        //dd($project);

        $validate = $request->validated();  //ricordati di validare sempre i dati con validated()


        if ($request->has('cover_image')) { //se la richiesta ha cover image allora entra nel ciclo


            if ($project->cover_image) { //se project ha conver image, allora vado in store e cancello la cover_image attuale
                
                Storage::delete($project->cover_image);
            }

            $image_path = Storage::put('uploads', $validate['cover_image']); //selvo la nuova cover image in storege
            //dd($validated, $image_path);
            $validate['cover_image'] = $image_path;
        }




        $project->update($validate);

        return to_route('admin.projects.index')->with('success', 'Project update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {

        if ($project->cover_image) { //se project ha conver image, allora vado in store e cancello la cover_image attuale, perchè altrimenti rimarrebbe il salvataggio di metà percorso nello storage 
           
            Storage::delete($project->cover_image);
        }

        $project->delete();

        return to_route('admin.projects.index')->with('success', 'Project destory successfully');
    }
}
