<?php

include(dirname(__FILE__) . '/../settings/default.php');
include(dirname(__FILE__) . '/../settings/functions.php');

include(dirname(__FILE__) . '/../connections/api.php');

include(dirname(__FILE__) . '/../models/NotifyCounts.php');

include(dirname(__FILE__) . '/../models/Portfolio.php');

$module     = 'forex';
$page       = 'profit-calculator';
$pageTitle  = 'Forex Profit Calculator';
$pageDescription  = "";

include './../MasterTop.php';
include './../Header.php';

?>
<section class="container-fluid cagr">
    <meta name="description" content="A profit calculator in Forex is a tool that calculates the potential profit or loss from a Forex trading position based on the given parameters">
    <meta name="keywords" content="proft calculator, profit, forex, trading, exchange, money, investment, profitability">

    <div id="forex-overview" style="font-weight:3px">
        <object data="<?php echo $base_url; ?>/public/widgets/forex-overview" width="100%" height="110" type="text/html"> Forex Overview </object>
    </div>
    <div class="row">
        <?php
        include './../SideBarLeft.php';
        ?>
        <div class="col-lg-3 pl-lg-4 pr-lg-0 mt-sm-minus-20 mb-3">
            <div class="cagr-calulator">
                <h1 style="font-size:24px; text-transform:uppercase">Profit Calculator <sup><span class="badge badge-danger font-11 font-weight-normal">Beta</span></sup></h1>
                <strong>Calculate Profit or Loss</strong>
                <div class="calculator-form border p-3 bg-white mt-2 mb-1 shadow-sm rounded">
                    <form action="#" method="POST" id="forexRiskCalculatorForm">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Currency Pair</label>
                                    <select id="currency-pair" class="form-control">
                                        <option value="EURUSD">EUR/USD</option>
                                        <option value="GBPUSD">GBP/USD</option>
                                        <option value="USDJPY">USD/JPY</option>
                                        <option value="AUDUSD">AUD/USD</option>
                                        <option value="USDCHF">USD/CHF</option>
                                        <option value="USDCAD">USD/CAD</option>
                                        <option value="NZDUSD">NZD/USD</option>
                                        <option value="EURAUD">EUR/AUD</option>
                                        <option value="EURJPY">EUR/JPY</option>
                                        <option value="EURCAD">EUR/CAD</option>
                                        <option value="EURCHF">EUR/CHF</option>
                                        <option value="EURNZD">EUR/NZD</option>
                                        <option value="CADJPY">CAD/JPY</option>
                                        <option value="EURGBP">EUR/GBP</option>
                                        <option value="GBPCHF">GBP/CHF</option>
                                        <option value="CHFJPY">CHF/JPY</option>
                                        <option value="GBPJPY">GBP/JPY</option>
                                        <option value="AUDCAD">AUD/CAD</option>
                                        <option value="NZDCAD">NZD/CAD</option>
                                        <option value="USDNOK">USD/NOK</option>
                                        <option value="GBPAUD">GBP/AUD</option>
                                        <option value="GBPNZD">GBP/NZD</option>
                                        <option value="CADCHF">CAD/CHF</option>
                                        <option value="AUDNZD">AUD/NZD</option>
                                        <option value="AUDJPY">AUD/JPY</option>
                                        <option value="AUDCHF">AUD/CHF</option>
                                        <option value="GBPCAD">GBP/CAD</option>
                                        <option value="NZDCHF">NZD/CHF</option>
                                        <option value="NZDJPY">NZD/JPY</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Account Currency</label>
                                    <select id="account-currency" class="form-control">
                                        <option value="USD" selected>USD</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Trade Size (Lots)</label>
                                    <input class="form-ctrl" type="number" value="1" id="trade-size" placeholder="Enter trade size" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Open Price</label>
                                    <input class="form-ctrl" type="number" value="1.08805" id="open-price" placeholder="Enter Open Price" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Close Price</label>
                                    <input class="form-ctrl" type="number" value="1.08816" id="close-price" placeholder="Enter Close Price" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Direction</label>
                                    <select id="direction" class="form-control">
                                        <option value="buy">Buy/Long</option>
                                        <option value="sell">Sell/Short</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-0 pb-0">
                                    <button type="submit" id="calculate-button" class="btn btn-success btn-sm">Calculate</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-9 pl-lg-3 pr-lg-4 mt-sm-minus-20 mb-3">
            <h2 style="font-size:24px; text-transform:uppercase"> &nbsp; </h2>
            <strong>&nbsp;</strong>
            <div class="calculator-result border p-3 bg-white mt-2 mb-1 rounded">
                <div class="loading text-center"><img src="<?php echo $base_url; ?>/img/loading.svg"></div>
                <div class="cagr_content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12" style="font-size: 24px;" id="result">
                                    Result: -- <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="about-cagr pt-2">
                <h5 class="mt-2" style="Font-size:17px !important;">Learn more about Profit Calculator</h5>
                <p class="mt-2">A profit calculator in Forex is a tool that calculates the potential profit or loss from a Forex trading position based on the given parameters such as the size of the position, the currency pair being traded, the exchange rate, and the price at which the trade is executed. The profit calculator also considers other important factors such as the cost of transaction and the exchange rate spread, which are crucial in determining the profitability of a Forex trade.</p>
                <p class="mt-2">To use a profit calculator in Forex, the user inputs the trade details such as the size of the position, the currency pair being traded, the exchange rate, and the price at which the trade is executed. The calculator then uses these inputs to calculate the potential profit or loss of the trade, taking into account the cost of transaction and the exchange rate spread.</p>
                <p class="mt-2">It is important to note that a profit calculator in Forex is just an estimate, and the actual profit or loss from a Forex trade may differ from the calculation made by the calculator. This is because the Forex market is highly volatile and the exchange rate can fluctuate rapidly, making it difficult to predict with certainty the outcome of a Forex trade.</p>
                <p class="mt-2">In conclusion, a profit calculator in Forex is a useful tool for Forex traders as it helps them to evaluate the potential profit or loss from a trade before executing it. By using a profit calculator, traders can make more informed decisions about their Forex trades and increase their chances of success.</p>
            </div>
        </div>
    </div>
</section>
<?php
include './../MasterFooter.php';
?>
<script>
    const currencyPairSelect = document.getElementById("currency-pair");
    const accountCurrencySelect = document.getElementById("account-currency");
    const tradeSizeInput = document.getElementById("trade-size");
    const openInput = document.getElementById("open-price");
    const closeInput = document.getElementById("close-price");
    const directionInput = document.getElementById("direction");
    const calculateButton = document.getElementById("calculate-button");
    const result = document.getElementById("result");

    // on button click
    calculateButton.addEventListener("click", event => {
        // prevent the default from submission behaviour
        event.preventDefault();
        // getting value and parsing into float
        const tradeSize = parseFloat(tradeSizeInput.value);
        const openPrice = parseFloat(openInput.value);
        const closePrice = parseFloat(closeInput.value);
        const direction = directionInput.value;
        const selectedCurrencyPair = currencyPairSelect.value;
        const selectedAccountCurrency = accountCurrencySelect.value;

        var baseCurrency = selectedCurrencyPair.slice(0, 3);
        var quoteCurrency = selectedCurrencyPair.slice(3, 6);
        var profit = parseFloat(0);
        var random = parseFloat(0);
        getRate("USD", quoteCurrency)
            .then((data) => {
                random = data;
            })
            .catch((error) => {
                console.log(error);
            })
        getRate(baseCurrency, quoteCurrency)
            .then((exchangeRate) => {
                if (direction === "buy") {
                    profit = (openPrice - closePrice) * tradeSize * 100000 * -1;
                } else {
                    profit = (openPrice - closePrice) * tradeSize * 100000 * 1;
                }

                if (quoteCurrency !== "USD" && baseCurrency === "USD") {
                    profit = profit / exchangeRate;
                } else if (quoteCurrency !== "USD" && baseCurrency !== "USD") {
                    profit = profit / random;
                }
                result.style.display = "block";
                if (profit === Infinity) {
                    result.innerText = `Press the Button Again`;
                } else {
                    result.innerText = `Result: ${profit.toFixed(4)} ${selectedAccountCurrency}`;
                }
            })
            .catch((error) => {
                console.log(error);
            })

    });

    function getRate(currencyFrom, currencyTo) {
        var myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

        var urlencoded = new URLSearchParams();
        urlencoded.append("currencyFrom", currencyFrom);
        urlencoded.append("currencyTo", currencyTo);
        urlencoded.append("price", 1);

        var requestOptions = {
            method: 'POST',
            headers: myHeaders,
            body: urlencoded,
            redirect: 'follow'
        };
        return new Promise((resolve, reject) => {
            fetch("https://sarmaaya.pk/api_prod/3.0/forex_calculator.php", requestOptions)
                .then(response => response.json())
                .then((data) => {
                    resolve(data.data["conversion"]);
                })
                .catch(error => reject(error));
        });
    }

    var select = document.getElementById("currency-pair");
    var options = select.options;
    var arr = [];
    for (var i = 0; i < options.length; i++) {
        arr.push(options[i]);
    }
    arr.sort(function(a, b) {
        return a.text == b.text ? 0 : (a.text > b.text ? 1 : -1);
    });
    for (var i = 0; i < arr.length; i++) {
        select.appendChild(arr[i]);
    }
</script>