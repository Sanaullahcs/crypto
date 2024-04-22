<!DOCTYPE html>

<html>

<head>



    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Design</title>

</head>

<style type="text/css">
.faq-item {

    margin-bottom: 20px;

}



.faq-question {

    display: flex;

    align-items: center;

    cursor: pointer;

    background: #fff;

    padding: 10px;

    border-radius: 8px;

}



.faq-answer {

    display: none;

    padding-left: 30px;

}



.faq-question .icon {

    margin-right: 10px;

    background: #4473c5;

    width: 20px;

    height: 20px;

    border-radius: 50px;

    position: relative;

}



.faq-question.open .icon::before {

    content: "-";

    color: #ffff;

    position: absolute;

    right: 5px;

    font-size: 23px;

    top: -9px;

    font-weight: 800;

}

.faq-answer p {

    margin-top: 12px;

}



.faq-question:not(.open) .icon::before {

    content: "+";

    color: #ffff;

    position: absolute;

    right: 3px;

    font-size: 20px;

    top: -7px;

    font-weight: 800;

}



.header-sect h2 {

    font-size: 18px;

    font-weight: 700;

    color: #000;

}



.header-sect p {

    font-size: 14px;

    color: #000;

}



.header-sect {

    padding: 40px 0;

}



.header-sect img {

    width: 100px;

}



section.banner-sect h1 {

    font-size: 36px;

    font-weight: 700;

    color: #000;

}



section.banner-sect p {

    color: #000;

    font-size: 14px;

    max-width: 600px;

    margin: auto;

}

.bg-light-blue {

    background: #cbe8fa;

    border-radius: 25px;

    padding: 30px 26px;

    margin-bottom: 25px;

}



.bg-light-blue h3 {

    font-size: 16px;

    font-weight: 700;

}



.bg-light-blue p {

    line-height: 18px;

}

section.platform-work {

    background: #cce7fa;

    padding: 60px 0 !important;

}



section.platform-work h2 {

    font-size: 36px;

    font-weight: 700;

    color: #000;

}



section.platform-work p {

    font-size: 14px;

    color: #000;

    max-width: 350px;

}



.side-icon {

    background: #fff;

    padding: 14px 14px 14px 60px;

    border-radius: 8px;

    position: relative;

    margin-bottom: 14px;

}



.bg-white-block {

    max-width: 360px;

    list-style: none;

    padding: 0px;

}



.side-icon h3 {

    font-size: 14px;

    color: #000;

    font-weight: 700;

    margin: 0;

}



.side-icon p {

    font-size: 12px !important;

    margin: 0;

}

section.choose-sect p {

    color: #000;

    font-size: 14px;

    max-width: 600px;

    margin: auto;

}



h2 {

    font-size: 36px;

    font-weight: 700;

    color: #000;

}

.card-sect {

    border: 1px solid #87a5da;

    border-radius: 12px;

    padding: 20px 40px;

    text-align: center;

    max-width: 32%;

    margin: auto;

    margin-bottom: 12px;

}



.card-sect h3 {

    font-size: 16px;

    color: #000;

    font-weight: 700;

}

section.faqs-sect {

    background: #cce7fa;

    padding: 60px 0;

    margin: 40px 0;

}



section.faqs-sect p {

    font-size: 14px;

    color: #000;

}

section.faqs-sect .row .col-12.col-sm-12.col-md-6.col-lg-6:first-child {

    max-width: 450px;

    margin-right: auto;

}

section.partners-sect p {

    color: #000;

    font-size: 14px;

    max-width: 600px;

    margin: auto;

}



footer.footer-site {

    background: #cae7f7;

    padding: 60px 0 20px;

}



footer.footer-site p {

    font-weight: 600;

    max-width: 320px;

    color: #000;

}



.copyright-text {

    text-align: center;

    border-top: 1px solid #87adde;

    padding-top: 8px;

    margin-top: 60px;

    color: #000;

    font-size: 14px;

}



footer.footer-site ul {

    list-style: none;

    padding: 0;

    margin-top: 22px;

}



footer.footer-site a {

    text-decoration: unset;

    font-size: 14px;

    color: #000;

    line-height: 30px;

}



footer.footer-site h3 {

    font-size: 17px;

    font-weight: 700;

    color: #000;

}
</style>



<body>

    <header class="header-sect">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-12 col-sm-12 col-md-2 col-lg-2">

                    <img src="{{ asset('home/logo.svg') }}" />

                </div>

                <div class="col-12 col-sm-12 col-md-8 col-lg-8 text-center">

                    <h2>Crypto Wix Guy*</h2>

                    <p>Know your profit before you sell</p>

                </div>

                <div class="col-12 col-sm-12 col-md-2 col-lg-2">

                    <select class="form-select" aria-label="Default select example">

                        <option selected>Open this select menu</option>

                        <option value="1">One</option>

                        <option value="2">Two</option>

                        <option value="3">Three</option>

                    </select>

                </div>

            </div>

        </div>

    </header>

    <section class="banner-sect">

        <div class="container">

            <h1 class="text-center">Lorem Ipsum</h1>

            <p class="text-center mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis lacinia mattis
                bibendum. Phasellus congue id velit eu dignissim. Fusce in lobortis dui, ut pellentesque lectus. </p>

            <div class="row">

                <div class="col-12 col-sm-12 col-md-3 col-lg-3">

                    <div class="bg-light-blue">

                        <h3>High Resolution</h3>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis lacinia mattis bibendum. </p>

                    </div>

                    <div class="bg-light-blue">

                        <h3>High Resolution</h3>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis lacinia mattis bibendum. </p>

                    </div>

                </div>

                <div class="col-12 col-sm-12 col-md-6 col-lg-6">

                    <img class="w-100" style="height: 300px; object-fit: cover;" src="{{ asset('home/map.png') }}" />

                </div>

                <div class="col-12 col-sm-12 col-md-3 col-lg-3">

                    <div class="bg-light-blue">

                        <h3>High Resolution</h3>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis lacinia mattis bibendum. </p>

                    </div>

                    <div class="bg-light-blue">

                        <h3>High Resolution</h3>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis lacinia mattis bibendum. </p>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <section class="platform-work my-5 py-4">

        <div class="container">

            <div class="row">

                <div class="col-12 col-sm-12 col-md-6 col-lg-6">

                    <img src="{{ asset('home/Platform.png') }}" />

                </div>

                <div class="col-12 col-sm-12 col-md-6 col-lg-6">

                    <h2>How Platform work</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis lacinia mattis bibendum. </p>

                    <ul class="bg-white-block">

                        <li class="side-icon">

                            <h3>Lorem ipsum dolor sit amet</h3>

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis lacinia mattis bibendum.
                            </p>

                        </li>

                        <li class="side-icon">

                            <h3>Lorem ipsum dolor sit amet</h3>

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis lacinia mattis bibendum.
                            </p>

                        </li>

                        <li class="side-icon">

                            <h3>Lorem ipsum dolor sit amet</h3>

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis lacinia mattis bibendum.
                            </p>

                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </section>

    <section class="choose-sect">

        <div class="container">

            <h2 class="text-center">Why Choose Us</h2>

            <p class="text-center mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis lacinia mattis
                bibendum. Phasellus congue id velit eu dignissim. Fusce in lobortis dui, ut pellentesque lectus. </p>

            <div class="row">

                <div class="col-12 col-sm-12 col-md-4 col-lg-4 card-sect">

                    <img class="mb-3" src="{{ asset('home/star.png') }}" />

                    <h3>Creative Chart Modules</h3>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis lacinia mattis bibendum. </p>

                </div>

                <div class="col-12 col-sm-12 col-md-4 col-lg-4 card-sect">

                    <img class="mb-3" src="{{ asset('home/star.png') }}" />

                    <h3>Creative Chart Modules</h3>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis lacinia mattis bibendum. </p>

                </div>

                <div class="col-12 col-sm-12 col-md-4 col-lg-4 card-sect">

                    <img class="mb-3" src="{{ asset('home/star.png') }}" />

                    <h3>Creative Chart Modules</h3>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis lacinia mattis bibendum. </p>

                </div>

                <div class="col-12 col-sm-12 col-md-4 col-lg-4 card-sect">

                    <img class="mb-3" src="{{ asset('home/star.png') }}" />

                    <h3>Creative Chart Modules</h3>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis lacinia mattis bibendum. </p>

                </div>

                <div class="col-12 col-sm-12 col-md-4 col-lg-4 card-sect">

                    <img class="mb-3" src="{{ asset('home/star.png') }}" />

                    <h3>Creative Chart Modules</h3>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis lacinia mattis bibendum. </p>

                </div>

                <div class="col-12 col-sm-12 col-md-4 col-lg-4 card-sect">

                    <img class="mb-3" src="{{ asset('home/star.png') }}" />

                    <h3>Creative Chart Modules</h3>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis lacinia mattis bibendum. </p>

                </div>

            </div>

        </div>

    </section>

    <section class="faqs-sect">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-12 col-sm-12 col-md-6 col-lg-6">

                    <h2>

                        Frequently Ask <br> Question

                    </h2>

                    <p class="my-4">

                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis lacinia mattis bibendum. Phasellus
                        congue id velit eu dignissim. Fusce in lobortis dui, ut pellentesque lectus.

                    </p>

                    <div class="faq-container">

                        <div class="faq-item">

                            <div class="faq-question closed">

                                <div class="icon"></div>

                                <div class="quest">Question 1: What is Lorem Ipsum?</div>

                            </div>

                            <div class="faq-answer">

                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

                            </div>

                        </div>

                        <div class="faq-item">

                            <div class="faq-question closed">

                                <div class="icon"></div>

                                <div class="quest">Question 2: Why do we use it?</div>

                            </div>

                            <div class="faq-answer">

                                <p>It is a long established fact that a reader will be distracted by the readable
                                    content of a page when looking at its layout.</p>

                            </div>

                        </div>

                        <div class="faq-item">

                            <div class="faq-question closed">

                                <div class="icon"></div>

                                <div class="quest">Question 3: Where does it come from?</div>

                            </div>

                            <div class="faq-answer">

                                <p>Contrary to popular belief, Lorem Ipsum is not simply random text.</p>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-12 col-sm-12 col-md-6 col-lg-6">

                    <img class="w-100" src="{{ asset('home/faqs.png') }}" />

                </div>

            </div>

        </div>

    </section>

    <section class="partners-sect">

        <div class="container">

            <h2 class="text-center">Our Powerful partners</h2>

            <p class="mb-5 text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis lacinia mattis
                bibendum. Phasellus congue id velit eu dignissim. Fusce in lobortis dui, ut pellentesque lectus. </p>

            <div class="row">

                <div class="col-12 col-sm-12 col-md-2 col-lg-2">

                    <img src="{{ asset('home/brands.png') }}">

                </div>

                <div class="col-12 col-sm-12 col-md-2 col-lg-2">

                    <img src="{{ asset('home/brands.png') }}">

                </div>

                <div class="col-12 col-sm-12 col-md-2 col-lg-2">

                    <img src="{{ asset('home/brands.png') }}">

                </div>

                <div class="col-12 col-sm-12 col-md-2 col-lg-2">

                    <img src="{{ asset('home/brands.png') }}">

                </div>

                <div class="col-12 col-sm-12 col-md-2 col-lg-2">

                    <img src="{{ asset('home/brands.png') }}">

                </div>

                <div class="col-12 col-sm-12 col-md-2 col-lg-2">

                    <img src="{{ asset('home/brands.png') }}">

                </div>

                <div class="col-12 col-sm-12 col-md-2 col-lg-2">

                    <img src="{{ asset('home/brands.png') }}">

                </div>

                <div class="col-12 col-sm-12 col-md-2 col-lg-2">

                    <img src="{{ asset('home/brands.png') }}">

                </div>

                <div class="col-12 col-sm-12 col-md-2 col-lg-2">

                    <img src="{{ asset('home/brands.png') }}">

                </div>

                <div class="col-12 col-sm-12 col-md-2 col-lg-2">

                    <img src="{{ asset('home/brands.png') }}">

                </div>

                <div class="col-12 col-sm-12 col-md-2 col-lg-2">

                    <img src="{{ asset('home/brands.png') }}">

                </div>

                <div class="col-12 col-sm-12 col-md-2 col-lg-2">

                    <img src="{{ asset('home/brands.png') }}">

                </div>

            </div>

        </div>



    </section>

    <footer class="footer-site">

        <div class="container">

            <div class="row">

                <div class="col-12 col-sm-12 col-md-4 col-lg-4">

                    <img src="{{ asset('home/logo.svg') }}" />

                    <p>Crypto Wiz Guy* <span>presents</span> The Cryptocurrency selling-for-PROFIT calculator </p>

                </div>

                <div class="col-12 col-sm-12 col-md-3 col-lg-3">

                    <h3>Our Portfolio</h3>

                    <ul>

                        <li>

                            <a href="#">Advertiser Agreement</a>

                        </li>

                        <li>

                            <a href="#">Advertiser Agreement</a>

                        </li>

                        <li>

                            <a href="#">Advertiser Agreement</a>

                        </li>

                        <li>

                            <a href="#">Advertiser Agreement</a>

                        </li>

                    </ul>

                </div>

                <div class="col-12 col-sm-12 col-md-3 col-lg-3">

                    <h3>Get in Touch</h3>

                    <ul>

                        <li>

                            <a href="#">678-505-8140</a>

                        </li>

                        <li>

                            <a href="#">info@cryptowizguy.com</a>

                        </li>

                    </ul>

                </div>

            </div>

            <div class="copyright-text">

                Cryptowizguy, All Rights Reserved

            </div>

        </div>

    </footer>













    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

    <script>
    const faqQuestions = document.querySelectorAll(".faq-question");



    faqQuestions.forEach((question) => {

        question.addEventListener("click", () => {

            question.classList.toggle("open");

            const answer = question.nextElementSibling;

            if (question.classList.contains("open")) {

                answer.style.display = "block";

            } else {

                answer.style.display = "none";

            }

        });

    });
    </script>

</body>

</html>