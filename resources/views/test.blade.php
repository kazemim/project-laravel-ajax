   {{-- foreach --}}
   @foreach ($posts as $key => $post)
       <tr class="">
           <th scope="row">{{ ++$key }}</th>
           <td>{{ $post->writer }}</td>
           <td>
               <p>
                   {{ $post->body }}
               </p>
           </td>
           <td>
               <div class="div-img"><img src="{{ asset($post->image) }}" alt="img1" class="img-fluid rounded-circle">
               </div>
           </td>
           <td>
               <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{ $post->id }}">Edit</button>


               <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletePost">Delete</button>

           </td>
       </tr>
   @endforeach

   {{-- end foreach --}}

   {{-- ------------------------------------------------------------------------ --}}
   {{-- start edit post modal --}}
   <!-- Modal -->
   <div class="modal fade" id="{{ $post->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
       aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Post</h1>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   {{-- ---body post --}}

                   <form method="POST" action="{{ route('updatePost', $post->id) }}" enctype="multipart/form-data">
                       @csrf
                       @method('PUT')
                       <div class="mb-3">
                           <label for="exampleFormControlInput1" class="form-label">Writer
                               Name</label>
                           <input name="writer" type="text" class="form-control" value="{{ $post->writer }}"
                               id="exampleFormControlInput1">
                       </div>
                       <div class="mb-3">
                           <label for="exampleFormControlTextarea1" class="form-label">Body
                               Post</label>
                           <textarea name="body" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $post->body }}</textarea>
                       </div>
                       <div class="mb-3">
                           <label for="SelectCategory" class="form-label">Select
                               Category</label>
                           <select name="category_id" id="SelectCategory" class="form-select"
                               aria-label="Default select example">
                               <option selected disabled>Open this select category</option>
                               @foreach ($categories as $category)
                                   <option value="{{ $category->id }}">{{ $category->title }}</option>
                               @endforeach

                           </select>
                       </div>

                       <div class="mb-3">
                           <label for="formFile" class="form-label">Select Image</label>
                           <input name="image" class="form-control" type="file" id="formFile">
                       </div>

                       <div class="mb-3">
                           <button type="submit" class="btn btn-outline-primary">Update
                               Post</button>
                       </div>
                   </form>
               </div>

           </div>
       </div>
   </div>
   {{-- end edit post modal --}}
