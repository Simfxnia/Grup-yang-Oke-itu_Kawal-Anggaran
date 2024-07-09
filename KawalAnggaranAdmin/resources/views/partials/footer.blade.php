<link href="{{ asset('css/footerstyle.css') }}" rel="stylesheet">
<footer>
    <div class="wrapperFoot">
        <div class="carouselFoot">
            <div class="news slide1 active">
                <p class="newsText">Yogyakarta has allocated Rp 5 billion from its cultural fund to enhance cultural tourism initiatives across the region. The funding, sourced from the city's cultural budget, aims to refurbish key heritage sites and support local artists through workshops and exhibitions. Governor Sri Sultan Hamengkubuwono X emphasized the importance of preserving Yogyakarta's rich cultural heritage while attracting more tourists to boost the local economy.</p>
                <p class="newsSource">Source: Yogyakarta Cultural Office, July 8, 2024</p>
            </div>
            <div class="news slide2">
                <p class="newsText">The Yogyakarta Municipal Council has approved a significant budget increase of Rp 3 trillion for education and infrastructure development in the upcoming fiscal year. The allocation, part of the city's broader effort to improve public services, will fund new school construction projects and road maintenance initiatives. Mayor Sri Paduka praised the decision, stating that investing in education and infrastructure is crucial for fostering sustainable growth and enhancing residents' quality of life. </p>
                <p class="newsSource">Source: Yogyakarta Municipal Council, July 8, 2024</p>
            </div>
            <div class="news slide3">
                <p class="newsText">Yogyakarta has unveiled a new environmental initiative with an investment of Rp 2 billion to promote sustainability and green practices in the city. The funds, allocated from the city's environmental budget, will support tree-planting programs, waste management improvements, and educational campaigns on eco-friendly practices. Governor Sri Sultan Hamengkubuwono X emphasized the city's commitment to preserving its natural resources and reducing its ecological footprint. </p>
                <p class="newsSource">Source: Yogyakarta Environmental Office, July 8, 2024</p>
            </div>
            <div class="news slide4">
                <p class="newsText">Yogyakarta's sports sector is set to receive a significant boost with a funding allocation of Rp 1.5 billion aimed at improving sports facilities and promoting youth participation in athletics. The investment, sourced from the city's sports development budget, will fund upgrades to local sports complexes, training programs for athletes, and sports tournaments to foster community engagement. Mayor Sri Paduka highlighted the role of sports in promoting a healthy lifestyle and strengthening social bonds among residents. </p>
                <p class="newsSource">Source: Yogyakarta Sports Development Board, July 8, 2024</p>
            </div>
            <div class="news slide5">
                <p class="newsText">Yogyakarta has allocated Rp 4 billion from its healthcare budget to enhance medical services and facilities across the region. The funding will support the construction of new health centers, purchase of medical equipment, and training for healthcare professionals. Governor Sri Sultan Hamengkubuwono X underscored the importance of accessible healthcare for all residents, aiming to improve health outcomes and ensure equitable healthcare access throughout Yogyakarta. </p>
                <p class="newsSource">Source: Yogyakarta Health Department, July 8, 2024</p>
            </div>
            <div class="news slide6">
                <p class="newsText">Yogyakarta has announced an investment of Rp 2.5 billion in youth empowerment programs aimed at fostering entrepreneurship and skill development among young residents. The initiative, funded by the city's youth development budget, will offer training workshops, startup grants, and mentorship opportunities to empower youth in pursuing their career aspirations. Mayor Sri Paduka highlighted the role of youth in driving innovation and economic growth in Yogyakarta. </p>
                <p class="newsSource">Source: Yogyakarta Youth Development Office, July 8, 2024</p>
            </div>
        </div>
    </div>
    <div class="line"></div>
    <div class="bottomFooter">
        <div class="textContact">
            <p class="contactFooter numFoot">(+62) 85426754163</p>
            <p class="contactFooter email">admin@kawalanggaran.id</p>
            <p class="contactFooter">Jl. Kaliurang No.Km. 14,5, Krawitan, Umbulmartani, Kec. Ngemplak, Kabupaten Sleman, Daerah Istimewa Yogyakarta 55584</p>
        </div>
        <div class="logoFooter">
            <img src="{{ asset('img/logo.png') }}" alt="">
        </div>
    </div>
</footer>
<script>
    document.addEventListener('DOMContentLoaded', () => {
    const carousel = document.querySelector('.carouselFoot');
    const slides = document.querySelectorAll('.news');
    let currentIndex = 0;

    const showSlide = (index) => {
        carousel.style.transform = `translateX(${-index * 100}%)`;
    };

    const nextSlide = () => {
        currentIndex = (currentIndex < slides.length - 1) ? currentIndex + 1 : 0;
        showSlide(currentIndex);
    };

    // Auto slide every 5 seconds
    setInterval(nextSlide, 10000);
    });
</script>
