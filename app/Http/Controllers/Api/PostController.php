<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$data['posts'] = Post::all();

		$successResponse = array(
			'status' => true,
			'message' => 'Post Get Successfully',
			'data' => $data,
		);
		return response()->json($successResponse, 200);
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		$title = $request->title;
		$description = $request->description;
		$image = $request->image;

		$validate = Validator::make(
			$request->all(),
			[
				'title' => 'required',
				'description' => 'required',
				'image'=>'required|mimes:png,jpeg,jpg,gif'
			]
		);
		if ($validate->fails()) {

			$ErrorResponse = array(
				'status' => false,
				'message' => 'Validation error',
				'errors' => $validate->errors()->all(),
			);
			return response()->json($ErrorResponse, 401);
		
		}else{
			//Image Upload Code start
			$imageExtention =$image->getClientOriginalExtension();
			$imageName = time()."".$imageExtention;
			$image->move(public_path('/uploads'),$imageName);
			//Image Upload Code end

			$PostData = array(
				'title' => $title,
				'description' => $description,
				'image'=>$imageName
			);
			$postData = Post::create($PostData);

			$successResponse = array(
				'status'=>true,
				'message'=>'Data Insert Successfully',
				'data'=>$postData,
		  );
		  return response()->json($successResponse,200);
		}

	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id)
	{
		$data['posts'] = Post::where('id',$id)->first();

		$successResponse = array(
			'status' => true,
			'message' => 'Post Single Data Get Successfully',
			'data' => $data,
		);
		return response()->json($successResponse, 200);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id)
	{
		$title = $request->title;
		$description = $request->description;
		$image = $request->image;
		$validate = Validator::make(
			$request->all(),
			[
				'title' => 'required',
				'description' => 'required',
			]
		);
		if ($validate->fails()) {

			$ErrorResponse = array(
				'status' => false,
				'message' => 'Validation error',
				'errors' => $validate->errors()->all(),
			);
			return response()->json($ErrorResponse, 401);
		
		}else{

			if(!empty($image)){
				//GET OLD IMAGE AND DELETE IT
				$GetOldImage = Post::select('id','image')->where('id',$id)->get();
				if(!empty($GetOldImage) && $GetOldImage[0]->image !=null){
					$unlinkImageName = $GetOldImage[0]->image;
					$path = public_path().'/uploads'.$unlinkImageName;
					if(file_exists($path)){
						unlink($path);
					}
				}	
				//GET OLD IMAGE AND DELETE IT

				//Image Upload Code start
				$imageExtention = $image->getClientOriginalExtension();
				$imageName = time()."".$imageExtention;
				$image->move(public_path('/uploads'),$imageName);
				//Image Upload Code end
				$PostData['image'] = $imageName;
			}
			
			$PostData = array(
				'title' => $title,
				'description' => $description,
			);

			$postData = Post::where('id',$id)->update($PostData);

			$successResponse = array(
				'status'=>true,
				'message'=>'Data Update Successfully',
				'data'=>$postData,
		  );
		  return response()->json($successResponse,200);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id)
	{
		$imageData = Post::where('id',$id)->first();
		if(isset($imageData) && !empty($imageData->id)){
			$filePath = public_path('/uploads/').$imageData->image;
			if(file_exists($filePath)){
				unlink($filePath);
			}
		}
		$deletePost = Post::where('id',$id)->delete();
		$successResponse = array(
			'status'=>true,
			'message'=>'Data delete Successfully',
	  );
	  return response()->json($successResponse,200);
	}
}
