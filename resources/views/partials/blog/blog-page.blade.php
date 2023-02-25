@if ($posts->isNotEmpty()) 

<section id="blog-page" class="pt-90 pb-120 gray-bg">
        <div class="container">
           <div class="row">
               <div class="col-lg-8">
               @foreach($posts as $post)
                   <div class="singel-blog mt-30">
                       <div class="blog-thum">
                           <img height="400" src="{{ url('storage/images/post/'.$post->post_image) }}" alt="Blog">
                       </div>
                       <div class="blog-cont">
                           <a href="#"><h3>{{$post->post_title}}</h3></a>
                           <ul>
                               <li><a href="#"><i class="fa fa-calendar"></i>{{$post->created_at}}</a></li>
                               
                               <li><a href="#"><i class="fa fa-tags"></i>{{$post->post_category}}</a></li>
                           </ul>
                           <p>{{Str::limit($post->post_description, 100)}}</p>
                           <button class="btn btn-dark mt-3" >
                            <a class="text-white" href="/Post/{{$post->id}}">Read More...</a> 
                           </button>
                       </div>
                   </div> 
               @endforeach    
                   <!-- singel blog -->
                    
               
                </div>
               <div class="col-lg-4">
                   <div class="saidbar">
                       <div class="row">
                           <div class="col-lg-12 col-md-6">
                               <div class="saidbar-search mt-30">
                                   <form method="POST" action="/Search">
                                    @csrf
                                       <input type="text" name="query" placeholder="Search">
                                       <button type="submit"><i class="fa fa-search"></i></button>
                                   </form>
                               </div> <!-- saidbar search -->
                               <div class="categories mt-30">
                                   <h4>Categories</h4>
                                   <ul>
                                       @foreach($categories as $category)
                                        <li><a href="/PostByCategory/{{$category->category_name}}">{{$category->category_name}}</a></li>
                                       @endforeach
                                   </ul>
                               </div>
                           </div> <!-- categories -->
                           
                       </div> <!-- row -->
                   </div> <!-- saidbar -->
               </div>
           </div> <!-- row -->
        </div> <!-- container -->
    </section>
    

    @else   
    <div class="cotainer p-5">
        <h3 class="my-5 text-center">No Blog Posts Found</h3>
    </div>
    
@endif
   