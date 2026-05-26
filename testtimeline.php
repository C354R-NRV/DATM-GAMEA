<!DOCTYPE html>
<html lang="en">
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f4f4f4;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

header {
    text-align: center;
    margin-bottom: 3rem;
}

h1 {
    font-size: 2.5rem;
    color: #333;
    margin-bottom: 0.5rem;
}

h2 {
    display: inline-block;
    background-color:rgb(8, 105, 114);
    color: #f4f4f4;
    padding: 0.5rem 1rem;
    font-size: 1.2rem;
}

.timeline {
    position: relative; 
}

.timeline::before {
    content: '';
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    width: 2px;
    height: 100%;
    background-color: #0498a5;
}

.crisis-item {
    width: 100%;
    /* margin-bottom: 2rem; */
    position: relative;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.5s ease;
}

.crisis-item.visible {
    opacity: 1;
    transform: translateY(0);
}

.crisis-content {
    width: calc(50% - 30px);
    padding: 0.2rem 1.5rem 0.2rem 1.5rem;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    position: relative;
}

.crisis-item:nth-child(odd) .crisis-content {
    margin-left: auto;
}

.crisis-item:nth-child(odd) .crisis-content::before {
    content: '';
    position: absolute;
    left: -30px;
    top: 20px;
    border: 15px solid transparent;
    border-right-color: white;
}

.crisis-item:nth-child(even) .crisis-content::before {
    content: '';
    position: absolute;
    right: -30px;
    top: 20px;
    border: 15px solid transparent;
    border-left-color: white;
}

.crisis-content h3 {
    color: #333;
    margin-bottom: 0.5rem;
}

.location {
    color: #666;
    font-style: italic;
    margin-bottom: 0.5rem;
}

.description {
    color: #444;
}

@media (max-width: 768px) {
    .timeline::before {
        left: 30px;
    }

    .crisis-content {
        width: calc(100% - 60px);
        margin-left: 60px !important;
    }

    .crisis-item:nth-child(odd) .crisis-content::before,
    .crisis-item:nth-child(even) .crisis-content::before {
        left: -30px;
        border-right-color: white;
        border-left-color: transparent;
    }
}

@media (max-width: 480px) {
    h1 {
        font-size: 2rem;
    }

    .container {
        padding: 1rem;
    }
}
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Crises Timeline</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>SOLICITUD: CRV-32233_2233</h1>
            <h2>Actuados durante la solicitud</h2>
        </header>

        <div class="timeline">
            <div class="crisis-item" data-year="1772">
                <div class="crisis-content">
                    <h3>The Credit Crisis of 1772</h3>
                    <div class="location">Place of Origin: London</div>
                    <p class="description">The crisis occurred when renowned bankers defaulted on their creditors.</p>
                </div>
            </div>

            <div class="crisis-item" data-year="1873">
                <div class="crisis-content">
                    <h3>Long Depression 1873-76</h3>
                    <div class="location">Place of Origin: USA</div>
                    <p class="description">The crisis was a result of the decrease in demand for US products by European countries.</p>
                </div>
            </div>

            <div class="crisis-item" data-year="1929">
                <div class="crisis-content">
                    <h3>The Great Depression 1929-39</h3>
                    <div class="location">Place of Origin: USA</div>
                    <p class="description">Initiated by the Wall Street crash, leading to massive loss of income and unemployment across the US.</p>
                </div>
            </div>

            <div class="crisis-item" data-year="1992">
                <div class="crisis-content">
                    <h3>OPEC Oil Price Shock 1992</h3>
                    <div class="location">Place of Origin: USA</div>
                    <p class="description">The crisis occurred when OPEC countries put an oil embargo on the US.</p>
                </div>
            </div>

            <div class="crisis-item" data-year="1993">
                <div class="crisis-content">
                    <h3>The Asian Crisis 1993</h3>
                    <div class="location">Place of Origin: Thailand</div>
                    <p class="description">Massive debt accumulation and speculative attacks resulted in severe economic shockwave when exchange rate against the dollar collapsed.</p>
                </div>
            </div>

            <div class="crisis-item" data-year="1997">
                <div class="crisis-content">
                    <h3>OPEC Oil Price Shock 1997</h3>
                    <div class="location">Place of Origin: USA</div>
                    <p class="description">The crisis resulted when a real estate economic bubble collapsed.</p>
                </div>
            </div>

            <div class="crisis-item" data-year="1998">
                <div class="crisis-content">
                    <h3>The Asian Crisis 1998</h3>
                    <div class="location">Place of Origin: Thailand</div>
                    <p class="description">Massive debt accumulation and speculative attacks resulted in severe economic shockwave when exchange rate against the dollar collapsed.</p>
                </div>
            </div>

            <div class="crisis-item" data-year="2000">
                <div class="crisis-content">
                    <h3>The Asian Crisis 2000</h3>
                    <div class="location">Place of Origin: Thailand</div>
                    <p class="description">Massive debt accumulation and speculative attacks resulted in severe economic shockwave when exchange rate against the dollar collapsed.</p>
                </div>
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
<script>
    $(document).ready(function() {
    // Function to check if element is in viewport
    function isElementInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    // Function to handle scroll animation
    function handleScroll() {
        $('.crisis-item').each(function() {
            if (isElementInViewport(this)) {
                $(this).addClass('visible');
            }
        });
    }

    // Initial check for visible elements
    handleScroll();

    // Add scroll event listener
    $(window).on('scroll resize', handleScroll);

    // Add click handler for crisis items
    $('.crisis-item').click(function() {
        $(this).find('.description').slideToggle(300);
    });

    // Sort crisis items by year
    const timeline = $('.timeline');
    const items = timeline.children('.crisis-item').get();
    items.sort(function(a, b) {
        const yearA = parseInt($(a).data('year'));
        const yearB = parseInt($(b).data('year'));
        return yearA - yearB;
    });
    $.each(items, function(index, item) {
        timeline.append(item);
    });
});
</script></body>
</html>