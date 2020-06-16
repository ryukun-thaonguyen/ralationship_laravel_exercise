<?php

namespace App\Http\Controllers;

use App\Category;
use App\Photo;
use App\PhotoDescription;
use App\Tag;
use App\Taggable;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    function index(){
       $photos=Photo::all();
       $last=$photos->last()->id;
       $tags=Tag::all(['name',"id"]);
       $categories=Category::all(['name',"id"]);
       foreach($photos as $p){
           $p->photo_description;
           $p->category;
           $p->tag;
           foreach($p->tag as $t){
            $tag=Tag::find($t->tag_id);
            $tag->tag;
            $t->name=$tag->name;
           }
       }
    //    echo "<pre>".json_encode($photos,JSON_PRETTY_PRINT)."</pre>";
    return view('admin',['photos'=>$photos,"tags"=>$tags,"categories"=>$categories,"lastId"=>$last]);
    }
    function addPhoto(Request $req){
        $photo=new Photo();
        $photo->category_id=$req->category;
        $photo->title=$req->title;
        $photo->image=$this->createImage($req->image,"storage/public");
        $photo->save();
        $tags=$req->tag;
        $tags=explode(" ",$tags);
        $description=new PhotoDescription();
        $description->photo_id=(int)($req->lastId)+1;
        $description->content=$req->content;
        $description->save();
        foreach($tags as $t){
            $taggable= new Taggable();
            $taggable->photo_id=(int)($req->lastId)+1;
            $taggable->tag_id=$t;
            $taggable->save();
        }
        return redirect('/');
    }

    public function delete(Request $req){
        $photoId=$req->photoId;
        $tags=json_decode($req->tags,true);
        foreach($tags as $t){
            Taggable::where("tag_id",$t["tag_id"])->where("photo_id",$photoId)->delete();
        }
        PhotoDescription::where("photo_id",$photoId)->delete();
        Photo::find($photoId)->delete();
        return redirect("/");
    }

    public function editRedirect(Request $req){
       $photo= Photo::find($req->photoId);
       $taggables=json_decode($req->tags,true);
       $description=PhotoDescription::all();
       foreach($description as $d){
           if($d->photo_id==$photo->id){
               $description=$d;
               break;
           }
       }
       $categories=Category::all(['name',"id"]);
       $tags=Tag::all(['name',"id"]);
       foreach($tags as $t){
         foreach($taggables as $tg){
             if($tg["tag_id"]==$t->id){
                 $t->isCheck=true;
             }
         }
       }
       return view('edit',[
         "photo"=>$photo,
         "description"=>$description,
         "tags"=>$tags,
         "categories"=>$categories
       ]);
    }
    public function update(Request $req){
        $photo=Photo::find($req->photoID);
        Taggable::where("photo_id",$photo->id)->delete();
        $description=PhotoDescription::all();
        foreach($description as $d){
            if($d->photo_id==$photo->id){
                $description=$d;
                break;
            }
        }
        $description->content=$req->content;
        $description->save();
        $photo->category_id=$req->category;
        $photo->title=$req->title;
        $photo->image=$this->createImage($req->image,"storage/public");
        $photo->save();
        $tags=$req->tag;
        $tags=explode(" ",$tags);
        foreach($tags as $t){
            $taggable= new Taggable();
            $taggable->tag_id=$t;
            $taggable->photo_id=$photo->id;
            $taggable->save();
        }
        return redirect("/");
    }

    public function createImage($img,$folderPath)
    {
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . uniqid() . '. '.$image_type;
        file_put_contents($file, $image_base64);
        return $file;
    }
}
