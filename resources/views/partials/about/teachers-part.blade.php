
<section id="teachers-part" class="pt-65 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-title mt-50 pb-35">
                        <h5>Featured Teachers</h5>
                        <h2>Meet Our teachers</h2>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="row">
            @foreach($teachers as $teacher)
                <div class="col-lg-3 col-sm-6">
                    <div class="singel-teachers mt-30 text-center">
                        <div class="image">
                            <img src="{{ url('storage/images/teacher/'.$teacher->image) }}" alt="Teachers">
                        </div>
                        <div class="cont">
                            <a href="teachers-singel.html"><h6>{{$teacher->name}}</h6></a>
                            <span>{{$teacher->field}}</span>
                        </div>
                    </div> <!-- singel teachers -->
                </div>
            @endforeach    
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    