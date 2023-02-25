<section id="teachers-part" class="pt-70 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-title mt-50">
                        <h5>Featured Teachers</h5>
                        <h2>Meet Our teachers</h2>
                    </div> <!-- section title -->
                    <div class="teachers-cont">
                        <p>
                            We have highly qualified teachers 
                        </p>
                        <a href="/teachers" class="main-btn mt-55">Career with us</a>
                    </div> <!-- teachers cont -->
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div class="teachers mt-20">
                        <div class="row">

                            @foreach($teachers as $teacher)
                            <div class="col-sm-6">
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
                    </div> <!-- teachers -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>