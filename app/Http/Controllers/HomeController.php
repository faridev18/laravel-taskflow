<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;

class HomeController extends Controller
{
    //
    public function index(){
        $data = "Hello world";
        return view('home')->with("data",$data);
    }

    public function products(){
        return view('products');
    }

    public function categories(){


        $categories = Categorie::all();
        // return view('categories.categories', compact('categories'));
        return view('categories.categories')->with('categories', $categories);
    }
    
    public function addcategory(){
        return view('categories.create');
    }


    public function savecategorie(Request $request) {

        $request->validate([
            'name'            => 'required',
            'image'           => 'required|file|image',
        ], [
            'name.required'            => 'Le champ nom est obligatoire.',
            'image.required'           => 'Le champ image est obligatoire.',
            'image.file'               => 'Le champ image doit être un fichier.',
            'image.image'              => 'Le champ image doit être une image.',
        ]);


        if ($request->hasFile('image')) {
            $fileNameWithExt = $request->file('image')->getClientOriginalName(); // Nom complet de l'image
            $fileName        = pathinfo($fileNameWithExt, PATHINFO_FILENAME); // Nom de l'image sans extension
            $extension       = $request->file('image')->getClientOriginalExtension(); // Extension de l'image
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension; // Nom de l'image à stocker

            // Stocker l'image dans storage/app/public/pubs
            $imagePath = $request->file('image')->storeAs('pubs', $fileNameToStore, 'public'); // Stockage de l'image
        }

        $category = Categorie::create([
            'name' => $request->name,
            'image' => $imagePath,
        ]);

        return redirect()->route('categories')->with('success', 'La catégorie a été ajoutée avec succès.');

        
    }


    public function deletecategorie($id) {

        $category = Categorie::find($id);
        $category->delete();

        return redirect()->route('categories')->with('success', 'La catégorie a été supprimée avec succès.');
    }
}
