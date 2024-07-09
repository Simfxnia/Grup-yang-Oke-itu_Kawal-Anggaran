<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link href="{{ asset('css/homepagestyle.css') }}" rel="stylesheet">
    <script src="{{ asset('js/script.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body>
    <div class="main">
        <div id="sidebar">
            <h2>Welcome to<br>Kawal Anggaran</h2>
            <p class="textSide">Save the hassle of looking at boring old dashboards and get your answers from our AI!</p>
            <div class="chatContain">
                <!-- <p>{{ $response }}</p> -->
                <!-- @if ($response) -->
                <p>{{ $response }}</p>

                <!-- <h2>Formatted Data Sent to LLM:</h2> -->
                <!-- <pre>haha</pre>
    @endif -->
            </div>
            <form method="POST" action="{{ url('/') }}" class="query">
                @csrf
                @csrf
                <!-- <label for="userQuery">Enter your query:</label> -->
                <input type="text" id="userQuery" name="userQuery" placeholder="Enter your Query" required> <!-- dont delete this line -->
                <button class="generateBtn">Show Me the Money Magic!</button> <!-- dont delete this line -->
            </form>

            <!-- <button class="generateBtn">
        Show Me the Money Magic!
      </button> -->
        </div>
        <div class="chatBtn" onclick="toggleSidebar()">
            <div class="iconContainer">
                <img class="sparks" src="img/sparks.png" alt="">
            </div>
        </div>
        <header id="header">
            <ul>
                <li><a href="#whatKA" id="about">About Us</a></li>
                <a href="/"><img src="img/logo.png" alt=""></a>
                <li><a href="login" id="/admin/regIncome/">Dashboards</a></li>
            </ul>
        </header>
        <section>
            <img src="img/cloud.png" id="cloud">
            <p id="heroKawal">Kawal Anggaran</p>
            <img src="img/prambanan.png" id="prambanan">
            <p id="financeGlasses">Finance Glasses</p>
            <div class="lineHero"></div>
            <p id="heroText">Curious where your tax money goes? Kawal Anggaran has the answers! <br>Kawal Anggaran makes government finances clear and easy to <br>understand with fun charts and real-time updates. Join us to boost <br>transparency and trust in our government. Explore now!</p>
        </section>
    </div>
    <div class="govSpent">
        <div class="howMuch">
            <p id="howMuch">How much?</p>
        </div>
        <div class="number">
            <div class="counter">
                <span>
                    <p>Rp</p>
                </span>
                <div id="counter">
                    <span class="digit">0</span>
                    <span>.</span>
                    <span class="digit">0</span>
                    <span class="digit">0</span>
                    <span class="digit">0</span>
                    <span>,</span>
                    <span class="digit">0</span>
                    <span class="digit">0</span>
                </div>
                <span>
                    <p>M</p>
                </span>
            </div>
        </div>
        <div class="gover">
            <p class="goverSpent">the Government spent</p>
            <p class="thisYear">This Year</p>
        </div>
    </div>
    <div id="whatKA">
        <p class="what">What's Kawal Anggaran</p>
        <div class="wrapper">
            <div class="carousel">
                <div class="slider slide1 active">
                    <div class="textSlider">
                        <p class="titleSlider">Why Kawal Anggaran?</p>
                        <p class="textSlider1">Ever wondered if your tax money is being used wisely? So did we! Kawal Anggaran was created to fight corruption and make government spending transparent. Now you can see exactly where every penny goes and help ensure our funds are used for the right reasons!</p>
                    </div>
                    <img src="img/slider1.png" alt="" class="imageSlider">
                </div>
                <div class="slider slide2">
                    <div class="textSlider">
                        <p class="titleSlider">How Kawal Anggaran was Made?</p>
                        <p class="textSlider1">From brainstorming sessions to late-night coding marathons, Kawal Anggaran was built with passion and a purpose. Our team of tech wizards and finance gurus joined forces to create a platform that’s not only powerful but also super easy to use. Now, everyone can keep an eye on government spending!</p>
                    </div>
                    <img src="img/slider2.png" alt="" class="imageSlider2">
                </div>
                <div class="slider slide3">
                    <div class="textSlider">
                        <p class="titleSlider">Dive into Kawal Anggaran!</p>
                        <p class="textSlider1">Ready to become a transparency hero? Dive into Kawal Anggaran! Our platform is packed with cool features like real-time updates and interactive charts. Get involved, stay informed, and help us build a more accountable government. Let's make a difference together!</p>
                    </div>
                    <img src="img/slider3.png" alt="" class="imageSlider3">
                </div>
            </div>
            <button class="prev"><img src="img/prev.png" alt="" class="btnImg"></button>
            <button class="next"><img src="img/next.png" alt="" class="btnImg"></button>
        </div>
    </div>
    <section class="budget">
        <div class="budgetLeft">
            <p class="regBudget">Regional<br>Budget</p>
            <img src="img/dots.png" alt="" class="ellipse">
            <p class="textBudget">Want to know what’s happening with your
                local funds? Kawal Anggaran lets you uncover the secrets of
                your region's budget! Discover how money is spent on schools,
                roads, parks, and other local projects. It’s your money,
                and now you can follow it every step of the way. Get
                the scoop on your regional budget and be a local finance
                expert!</p>
        </div>
        <div class="budgetRight">
            <div class="budgetTitle">Regional Income<br>
                <p class="budgetNumber">{{ $totalAnggaranIncome }} M</p>
            </div>
            <div class="budgetTitle">Regional Expenditure<br>
                <p class="budgetNumber">{{ $totalAnggaranExp }} M</p>
            </div>
            <div class="budgetTitle">Regional Financing<br>
                <p class="budgetNumber">{{ $totalAnggaranFin }} M</p>
            </div>
        </div>
    </section>
    <!-- <div class="graphSection">
        <div class="graph">
            <p id="textGraph">Budget & Spent Graph</p>
            <div class="chart-wrapper">
                <div class="chart-container">
                    <canvas id="budgetSpentChart"></canvas>
                </div>
            </div>
        </div>
    </div> -->
    <div class="graphSection">
        <div class="graph">
            <div class="graphTop">
                <div class="graphTittle">
                    <h2 class="budgetnSpent">Budget and Spent</h2>
                    <p class="monthTo">Month-to-month Comparison</p>
                </div>
                <div class="colorIndicator">
                    <div class="pulse pulseBudget"></div>
                    <p class="bug">Budget</p>
                    <div class="pulse pulseSpent"></div>
                    <p>Spent</p>
                </div>
            </div>
            <div class="graphBottom">
                <div class="chart-area">
                    <canvas id="myLineChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</body>

@include("partials.foot")

<script>
    document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('myLineChart').getContext('2d');
    var realisasiPerMonth = @json($realisasiPerMonth);
    
    var currentMonth = "{{ $selectedMonth }}";
    var monthOrder = [
        'January', 'February', 'March', 'April', 'May', 'June',
        'July', 'August', 'September', 'October', 'November', 'December'
    ];
    
    var currentMonthIndex = monthOrder.indexOf(currentMonth);
    var filteredMonths = monthOrder.slice(0, currentMonthIndex + 1);

    var realisasiData = filteredMonths.map(month => realisasiPerMonth[month]);
    var anggaran = Array(filteredMonths.length).fill({{ $totalAnggaranExp }}); // Array with $totalAnggaranExp repeated

    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: filteredMonths,
            datasets: [
                {
                    label: 'Spent',
                    data: realisasiData,
                    borderColor: '#00E0FF',
                    backgroundColor: '#00E0FF',
                    fill: false,
                },
                {
                    label: 'Budget',
                    data: anggaran,
                    borderColor: '#000BFF',
                    backgroundColor: '#000BFF',
                    fill: false,
                },
            ],
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true,
                },
                y: {
                    beginAtZero: true,
                }
            }
        }
    });
});

</script>

</html>