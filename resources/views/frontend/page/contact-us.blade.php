@extends('layouts.frontend.master')

@section('title')
Contat us
@endsection
@section('content')
<!-- Start Contact Area -->
<section class="wn_contact_area bg--white pt--80 pb--80">
    <div class="google__map pb--80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <iframe style="width:100%; min-height:400px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27626.697295211037!2d31.2042615804168!3d30.055868590183383!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145840e059d98225%3A0x91cb6f582e8b215c!2sZamalek%2C%20Cairo%20Governorate!5e0!3m2!1sen!2seg!4v1630571405585!5m2!1sen!2seg"  style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="contact-form-wrap">
                    <h2 class="contact__title">Get in touch</h2>
                    <p>Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. </p>
                    <form  id="add-contact-message" action="{{ route('contact-us.store') }}" method="post">
                        @csrf
                        @method('POST')
                        <div class="single-contact-form ">
                            <input type="text" class="field" name="name" placeholder="Name*">
                            <strong id='name-error' class="error"> </strong>
                        </div>
                        <div class="single-contact-form">
                            <input type="email" name="email" class="field" placeholder="Email*">
                            <br>
                            <strong id='email-error' class="error"> </strong>
                        </div>

                        <div class="single-contact-form">
                            <input type="number" class="field" name="mobile" placeholder="mobile">
                        </div>

                        <div class="single-contact-form">
                            <input type="text" class="field" name="subject" placeholder="Subject*">
                            <strong id='subject-error' class="error"> </strong>
                        </div>
                        <div class="single-contact-form message">
                            <textarea  class="field"  name="message" placeholder="Type your message here.."></textarea>
                            <strong id='message-error' class="error"> </strong>
                        </div>
                        <div class="contact-btn">
                            <button type="submit">Send Email</button>

                        </div>
                    </form>
                </div>
                <div class="form-output">
                    <p class="form-messege">
                </div>
            </div>
            <div class="col-lg-4 col-12 md-mt-40 sm-mt-40">
                <div class="wn__address">
                    <h2 class="contact__title">Get office info.</h2>
                    <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. </p>
                    <div class="wn__addres__wreapper">

                        <div class="single__address">
                            <i class="icon-location-pin icons"></i>
                            <div class="content">
                                <span>address:</span>
                                <p>666 5th Ave New York, NY, United</p>
                            </div>
                        </div>

                        <div class="single__address">
                            <i class="icon-phone icons"></i>
                            <div class="content">
                                <span>Phone Number:</span>
                                <p>716-298-1822</p>
                            </div>
                        </div>

                        <div class="single__address">
                            <i class="icon-envelope icons"></i>
                            <div class="content">
                                <span>Email address:</span>
                                <p>716-298-1822</p>
                            </div>
                        </div>

                        <div class="single__address">
                            <i class="icon-globe icons"></i>
                            <div class="content">
                                <span>website address:</span>
                                <p>716-298-1822</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Contact Area -->
@endsection

