<section id="course-part" class="pt-115 pb-120 gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title pb-45">
                        <h5>Our course</h5>
                        <h2>Featured courses </h2>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="row  mt-30">
                @foreach($courses as $course)
                <div class="col-lg-4">
                    <div class="singel-course">
                        <div class="thum">
                            <div class="image">
                                <img src="images/course/cu-1.jpg" alt="Course">
                            </div>
                            <div class="price">
                                <span>{{$course->price}}</span>
                            </div>
                        </div>
                        <div class="cont">
                            <a >
                                <h4>{{$course->name}}</h4>
                            </a>
                            <div class="course-teacher">
                                <div class="thum">
                                    <a href="#"><img src="images/course/teacher/t-1.jpg" alt="teacher"></a>
                                </div>
                                <div class="name">
                                    <a href="#"><h6>Mark anthem</h6></a>
                                </div>
                                <div class="admin">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-user"></i><span>31</span></a></li>
                                        <li><a href="#"><i class="fa fa-heart"></i><span>10</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> <!-- singel course -->
                </div>
                @endforeach
            </div> <!-- course slied -->
        </div> <!-- container -->
    </section>