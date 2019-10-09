<?php

namespace App\Http\Controllers\Admin;

use App\Eloquent\Blog\Category;
use App\Eloquent\Blog\PostImage;
use App\Eloquent\Blog\Post;
use App\Eloquent\Blog\PostTag;
use App\Eloquent\Blog\Tag;
use App\Http\Requests\Blog\CreateCategory;
use App\Http\Requests\Blog\CreatePost;
use App\Http\Requests\Blog\CreateTag;
use App\Http\Requests\Blog\UpdateCategory;
use App\Http\Requests\Blog\UpdatePost;
use App\Http\Requests\Blog\UpdateTag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    //---------------------------------Tags-----------------------------------//

    public function tags() {
        $nav_bar = 'Tags';
        $active_page = 'Tags';
        $tags = [];
        $tags = Tag::all();
        return view('admin.blog.tags.tags', compact('nav_bar', 'active_page', 'tags'));
    }

    public function createTagView()
    {
        $nav_bar = 'Tags';
        $active_page = 'New tag';
        return view('admin.blog.tags.tag_info', compact('nav_bar', 'active_page'));
    }

    public function createTag(CreateTag $request)
    {
        if($request->isXmlHttpRequest()){
            $tag = new Tag;
            $tag->tag_name = $request->tag_name;
            $tag->save();
            return response()->json(array('success' => true));
        } else {
            return abort(404);
        }
    }

    public function editTagView($id)
    {
        if(count(Tag::where('id', $id)->get())>0){
            $tag = Tag::where('id', $id)->get()->first();
            $nav_bar = 'Tag';
            $active_page = 'Update tag';
            return view('admin.blog.tags.tag_info', compact('nav_bar', 'active_page', 'tag'));
        } else {
            return abort(404);
        }
    }

    public function editTag(UpdateTag $request, $id)
    {
        $tag = Tag::where('id', $id)->get()->first();
        $tag->tag_name = $request->tag_name;
        $tag->update();
        return response()->json(array('success' => true));
    }

    public function  removeTag(Request $request)
    {
        Tag::where('id',$request->tag_id)->delete();
        return response()->json(array('success' => true));
    }

    //---------------------------------Categories-----------------------------------//

    public function categories()
    {
        $nav_bar = 'Categories';
        $active_page = 'Categories';
        $categories = [];
        $categories = Category::all();
        return view('admin.blog.categories.categories', compact('nav_bar', 'active_page', 'categories'));
    }

    public function createCategoryView()
    {
        $nav_bar = 'Categories';
        $active_page = 'New category';
        return view('admin.blog.categories.category_info', compact('nav_bar', 'active_page'));
    }

    public function createCategory(CreateCategory $request)
    {
        if($request->isXmlHttpRequest()){
            $category = new Category;
            $category->category = $request->category;
            $category->save();
            return response()->json(array('success' => true));
        } else {
            return abort(404);
        }
    }

    public function editCategoryView(Request $request, $id)
    {
        if(count(Category::where('id', $id)->get())>0){
            $category = Category::where('id', $id)->get()->first();
            $nav_bar = 'Category';
            $active_page = 'Update category';
            return view('admin.blog.categories.category_info', compact('nav_bar', 'active_page', 'category'));
        } else {
            return abort(404);
        }
    }

    public function editCategory(UpdateCategory $request, $id)
    {
        $category = Category::where('id', $id)->get()->first();
        $category->category = $request->category;
        $category->update();
        return response()->json(array('success' => true));
    }

    public function  removeCategory(Request $request)
    {
        Category::where('id',$request->category_id)->delete();
        return response()->json(array('success' => true));
    }

    //---------------------------------Posts-----------------------------------//

    public function posts()
    {
        $nav_bar = 'Posts';
        $active_page = 'Posts';
        $posts = [];
        $posts = Post::all();
        return view('admin.blog.posts.posts', compact('nav_bar', 'active_page', 'posts'));
    }

    public function createPostView()
    {
        $nav_bar = 'Posts';
        $active_page = 'New post';
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.blog.posts.post_info', compact('nav_bar', 'active_page','categories','tags'));
    }

    public function createPost(CreatePost $request)
    {
        dd($request->all());
        if($request->isXmlHttpRequest()){
//            Save data in post
            $post = new Post();
            $post->post_content = $request->post_content;
            $post->post_category = $request->post_category;
            $post->post_title = $request->post_title;
            $post->save();
//            Save data in tag
            foreach ($request->post_tags as $tag_id){
                $post_tags = new PostTag();
                $post_tags->tag_id = $tag_id;
                $post_tags->post_id = $post->id;
                $post_tags->save();
            }
//            Save data in image
            preg_match_all('@src="([^"]+)"@', $request->post_content, $result);
            $postImages = PostImage::where('post_id', 0)->whereNotIn('image_path', $result[1]);
            if(!empty($postImages)){
                foreach ($postImages as $postImage){
                    unlink($postImage->image_path);
                }
                $postImages->delete();
            }
            PostImage::where('post_id', 0)->whereIn('image_path', $result[1])->update(['post_id' => $post->id]);

            return response()->json(array('success' => true));
        } else {
            return abort(404);
        }
    }

    public function editPostView(Request $request, $id)
    {
        if(count(Post::where('id', $id)->get())>0){
            $post = Post::where('id', $id)->get()->first();
            $postTags =[];
            foreach($post->postTags as $tag) {
                $postTags[$tag->tag->id]= $tag->tag->id;
            }
            $categories = Category::all();
            $tags = Tag::all();
            $nav_bar = 'Post';
            $active_page = 'Update post';
            return view('admin.blog.posts.post_info', compact('nav_bar', 'active_page', 'postTags', 'post', 'categories', 'tags'));
        } else {
            return abort(404);
        }
    }

    public function editPost(UpdatePost $request, $id)
    {
    //        Save content data
        $post = Post::where('id', $id)->get()->first();
        $post->post_content = $request->post_content;
        $post->post_category = $request->post_category;
        $post->post_title = $request->post_title;
        $post->update();
    //        Save post tags data
        PostTag::where('post_id', $id)->whereNotIn('tag_id', $request->post_tags)->delete();
        $postTag = PostTag::where('post_id', $id)->pluck('tag_id')->toArray();
        foreach($request->post_tags as $tag) {
            if(!in_array($tag, $postTag)){
                $newTag = new PostTag();
                $newTag->tag_id = $tag;
                $newTag->post_id = $id;
                $newTag->save();
            }
        }
    //        Save image data
        preg_match_all('@src="([^"]+)"@', $request->post_content, $result);
        $postImages = PostImage::whereIn('post_id', [$id, 0])->whereNotIn('image_path', $result[1]);
        if(!empty($postImages)){
            foreach ($postImages->get() as $postImage){
                unlink(public_path().$postImage->image_path);
            }
            $postImages->delete();
        }
        PostImage::where('post_id', 0)->whereIn('image_path', $result[1])->update(['post_id' => $post->id]);

        return response()->json(array('success' => true));
    }

    public function removePost(Request $request) {
        PostTag::where('post_id', $request->post_id)->delete();
        $postImages = PostImage::where('post_id', $request->post_id);
        if(!empty($postImages)){
            foreach ($postImages->get() as $postImage){
                unlink(public_path().$postImage->image_path);
            }
            $postImages->delete();
        }
        Post::where('id', $request->post_id)->delete();
        return response()->json(array('success' => true));
    }

    public function uploadImg(Request $request)
    {
        if ($request->has('upload')){
            $file = $_FILES['upload']['tmp_name'];
            $file_name =$_FILES['upload']['name'];
            $file_name_array = explode('.', $file_name);
            $extension = end($file_name_array);
            $new_image_name = rand().'.'.$extension;
            $allowed_extension = ["jpg","gif","png","jpeg"];
            if (in_array($extension, $allowed_extension)) {
                move_uploaded_file($file, public_path().'/img/post/'.$new_image_name);
                $url = '/img/post/'.$new_image_name;
                $postImage = new PostImage();
                $postImage->post_id = 0;
                $postImage->image_path = $url;
                $postImage->save();
                return  "<script>window.parent.CKEDITOR.tools.callFunction('{$request->CKEditorFuncNum}','{$url}','')</script>";
            }
        }
    }
}
