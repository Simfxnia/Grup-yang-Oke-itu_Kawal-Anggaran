document.addEventListener('DOMContentLoaded', () => {
    const carousel = document.querySelector('.carousel');
    const slides = document.querySelectorAll('.slider');
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');

    let currentIndex = 0;

    const showSlide = (index) => {
        carousel.style.transform = `translateX(${-index * 100}%)`;
    };

    prevButton.addEventListener('click', () => {
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : slides.length - 1;
        showSlide(currentIndex);
    });

    nextButton.addEventListener('click', () => {
        currentIndex = (currentIndex < slides.length - 1) ? currentIndex + 1 : 0;
        showSlide(currentIndex);
    });

    // Optional: Auto slide every 5 seconds
    setInterval(() => {
        nextButton.click();
    }, 10000);
});

document.addEventListener('DOMContentLoaded', function() {
    const months = window.months; // Access months array from the global window object
    const anggaranValues = window.anggaranValues; // Access anggaranValues array from the global window object
    const realisasiValues = window.realisasiValues; // Access realisasiValues array from the global window object

    var ctx = document.getElementById('myLineChart').getContext('2d');

    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Anggaran',
                data: anggaranValues,
                borderColor: 'blue',
                fill: false
            }, {
                label: 'Realisasi',
                data: realisasiValues,
                borderColor: 'red',
                fill: false
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Anggaran and Realisasi'
            },
            scales: {
                x: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Month'
                    }
                },
                y: {
                    display: true,
                    title: {
                        display: true,
                        text: 'Amount'
                    }
                }
            }
        }
    });
});



// script.js
document.addEventListener('DOMContentLoaded', function () {
    const targetValue = 153381;
    const duration = 2000;
    const counter = document.getElementById('counter');
    const digits = counter.getElementsByClassName('digit');
    let hasAnimated = false; // To prevent multiple animations

    function animateCounter(start, end, duration) {
        const range = end - start;
        const minTimer = 50;
        let stepTime = Math.abs(Math.floor(duration / range));

        stepTime = Math.max(stepTime, minTimer);

        const startTime = new Date().getTime();
        const endTime = startTime + duration;
        let timer;

        function run() {
            const now = new Date().getTime();
            const remaining = Math.max((endTime - now) / duration, 0);
            const value = Math.round(end - (remaining * range));
            updateCounter(value);

            if (value === end) {
                clearInterval(timer);
            }
        }

        timer = setInterval(run, stepTime);
        run();
    }

    function updateCounter(value) {
        const valueStr = value.toString().padStart(6, '0');
        for (let i = 0; i < digits.length; i++) {
            digits[i].textContent = valueStr[i];
        }
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && !hasAnimated) {
                hasAnimated = true;
                animateCounter(0, targetValue, duration);
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.5  // Adjust this value to control when the animation starts
    });

    observer.observe(document.querySelector('.govSpent'));
});

let cloud = document.getElementById('cloud');
        let heroKawal = document.getElementById('heroKawal');
        let prambanan = document.getElementById('prambanan');
        let financeGlasses = document.getElementById('financeGlasses');

        window.addEventListener('scroll', function(){
            let value = window.scrollY;

            let maxScroll = window.innerHeight;
        
            if (value < maxScroll) {
                heroKawal.style.top = 344 + value * 2 + 'px';
            } else {
                heroKawal.style.top = 344 + maxScroll * 2 + 'px';
            }
        })

        let primaryColor = getComputedStyle(document.documentElement)
        .getPropertyValue("--color-primary")
        .trim();
      
      let secondaryColor = getComputedStyle(document.documentElement)
        .getPropertyValue("--color-secondary")
        .trim();
      
      let labelColor = getComputedStyle(document.documentElement)
        .getPropertyValue("--color-label")
        .trim();
      
      let fontFamily = getComputedStyle(document.documentElement)
        .getPropertyValue("--font-family")
        .trim();
      
        let defaultOptions = {
          chart: {
            tollbar: {
              show: false,
            },
            zoom: {
              enabled: false,
            },
            width: "100%",
            height: "100%",
            offsetY: 18,
          },
        
          dataLabels: {
            enabled: false,
          },
        };
        
        let barOptions = {
          ...defaultOptions,
        
          chart: {
            ...defaultOptions.chart,
            type: "area",
          },
        
          tooltip: {
            enabled: true,
            style: {
              fontFamily: fontFamily,
              fontSize: "18px",
            },
            y: {
              formatter: (value) => `${value}M`,
            },
          },
        
          series: [
            {
              name: "Budget",
              data: [10, 8, 12, 15, 11, 9, 7, 10, 14, 8, 10, 13],
            },
            {
                name: "Spent",
                data: [7, 6, 9, 11, 8, 6, 5, 4, 7, 5, 6, 9],
              },
          ],
        
          colors: [primaryColor, secondaryColor],
        
          // fill: {
          //   type: "gradient",
          //   gradient: {
          //     type: "vertical",
          //     opacityFrom: 1,
          //     opacityTo: 0,
          //     stops: [0, 100],
          //     colorStops: [
          //       {
          //         offset: 0,
          //         opacity: 0.2,
          //         color: "#7e84f7",
          //       },
          //       {
          //         offset: 100,
          //         opacity: 0,
          //         color: "#ffffff",
          //       },
          //     ],
          //   },
          // },
        
          stroke: {
            colors: [primaryColor, secondaryColor],
            lineCap: "round",
          },
        
          grid: {
            borderColor: "rgba(0, 0, 0, 0)",
            padding: {
              top: -30,
              right: 0,
              bottom: -8,
              left: 12,
            },
          },
        
          markers: {
            strokeColors: [primaryColor, secondaryColor],
          },
        
          yaxis: {
            show: false,
          },
        
          xaxis: {
            labels: {
              show: true,
              floating: true,
              style: {
                colors: labelColor,
                fontFamily: fontFamily,
              },
            },
        
            axisBorder: {
              show: false,
            },
        
            crosshairs: {
              show: false,
            },
        
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "July", "Aug", "Sept", "Oct", "Nov", "Dec"],
          },
        };
        
        let chart = new ApexCharts(document.querySelector(".chart-area"), barOptions);
        
        chart.render();

        function toggleSidebar() {
          var sidebar = document.getElementById('sidebar');
          var chatBtn = document.querySelector('.chatBtn');
          sidebar.classList.toggle('active');
          chatBtn.classList.toggle('active');
        }