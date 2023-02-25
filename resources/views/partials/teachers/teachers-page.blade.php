    <!--====== TEACHERS PART START ======-->
    
    <section id="teachers-page" class="pt-90 pb-120 gray-bg">
        <div class="container">
           <div class="row">

                @foreach($teachers as $teacher)

               <div class="col-lg-3 col-sm-6">
                   <div class="singel-teachers mt-30 text-center">
                        <div class="image">
                            <img src="{{ url('storage/images/teacher/'.$teacher->image) }}" alt="Teachers">
                        </div>
                        <div class="cont" style="opacity: 0.5;">
                            <a href="#"><h6>{{$teacher->name}}</h6></a>
                            <span>{{$teacher->field}}</span>
                        </div>
                    </div> <!-- singel teachers -->
               </div>

               @endforeach
               
           </div> <!-- row -->
            
        </div> <!-- container -->
    </section>
    
    <!--====== TEACHERS PART ENDS ======-->