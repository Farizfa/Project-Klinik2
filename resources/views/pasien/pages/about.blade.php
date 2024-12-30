<!-- About Section -->
<section id="about" class="about section">

    <div class="container">

        <div class="row gy-4 gx-5">

            <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="200">
                <img src="{{ asset('Medilab/assets/img/about.jpg') }}" class="img-fluid" alt="Tentang Bengkelab">
                <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
            </div>

            <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                <h3>Tentang Kami</h3>
                <p>
                    SehatSentosa Clinic hadir sebagai pusat kesehatan terpercaya yang memberikan layanan berkualitas
                    dan modern. Kami didukung oleh tenaga medis profesional dan fasilitas yang memadai untuk memenuhi
                    kebutuhan kesehatan Anda.
                </p>
                <ul>
                    <li>
                        <i class="fa-solid fa-vial-circle-check"></i>
                        <div>
                            <h5>Layanan Kesehatan yang Terjamin</h5>
                            <p>Kami memastikan setiap layanan dilakukan dengan penuh dedikasi dan sesuai standar
                                kesehatan terbaik.</p>
                        </div>
                    </li>
                    <li>
                        <i class="fa-solid fa-pump-medical"></i>
                        <div>
                            <h5>Fasilitas Modern dan Lengkap</h5>
                            <p>Kami memiliki peralatan medis modern untuk mendukung diagnosis dan pengobatan yang
                                akurat.</p>
                        </div>
                    </li>
                    <li>
                        <i class="fa-solid fa-heart-circle-xmark"></i>
                        <div>
                            <h5>Prioritas pada Kesehatan Anda</h5>
                            <p>Kami berkomitmen untuk memberikan pengalaman terbaik bagi pasien dengan pelayanan yang
                                ramah dan profesional.</p>
                        </div>
                    </li>
                </ul>
            </div>

        </div>

    </div>

</section><!-- /About Section -->

<section id="stats" class="stats section light-background">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

            <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                <i class="fa-solid fa-user-doctor"></i>
                <div class="stats-item">
                    <span data-purecounter-start="0" data-purecounter-end="{{ $count }}"
                        data-purecounter-duration="1" class="purecounter"></span>
                    <p>Doctors</p>
                </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                <i class="fa-regular fa-hospital"></i>
                <div class="stats-item">
                    <span data-purecounter-start="0" data-purecounter-end="{{ $policount }}"
                        data-purecounter-duration="1" class="purecounter"></span>
                    <p>Poli</p>
                </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                <i class="fas fa-flask"></i>
                <div class="stats-item">
                    <span data-purecounter-start="0" data-purecounter-end="12" data-purecounter-duration="1"
                        class="purecounter"></span>
                    <p>Research Labs</p>
                </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
                <i class="fas fa-award"></i>
                <div class="stats-item">
                    <span data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="1"
                        class="purecounter"></span>
                    <p>Awards</p>
                </div>
            </div><!-- End Stats Item -->

        </div>

    </div>

</section><!-- /Stats Section -->
