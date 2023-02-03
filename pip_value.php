<?php

include(dirname(__FILE__) . '/../settings/default.php');
include(dirname(__FILE__) . '/../settings/functions.php');

include(dirname(__FILE__) . '/../connections/api.php');

include(dirname(__FILE__) . '/../models/NotifyCounts.php');

include(dirname(__FILE__) . '/../models/Portfolio.php');

$module     = 'forex';
$page       = 'pip-value';
$pageTitle  = 'Forex Pip Calculator';
$pageDescription  = "A pip (percentage in point/price interest point)calculator is a tool used in forex trading to determine the value of a pip, which is a unit of measurement for the change in a currency pair's exchange rate. The pip calculator can be used to determine the monetary value of a single pip based on the size of the trade and the currency pair being traded. This can help traders to more accurately manage their risk and determine the potential profit or loss of a trade. Some pip calculators also include additional features such as the ability to calculate the value of a pip for different account denominations, or to calculate the spread between the bid and ask prices of a currency pair.";

include './../MasterTop.php';
include './../Header.php';

?>
<section class="container-fluid cagr">
    <meta name="description" content="A pip (percentage in point/price interest point)calculator is a tool used in forex trading to determine the value of a pip, which is a unit of measurement for the change in a currency pair's exchange rate.">
    <meta name="keywords" content="pip value, pip calculator, forex pip value, pip value calculator, pips value, pip calculator forex, pip value in forex, calculate pip value, forex pip calculator, pip value formula, pip value chart, pip value table, what is a pip value, pip value of currency pairs, pip value of gold, pip value of oil, pip value of stock, pip value in trading, pip value in currency trading, pip value in forex trading, pip value in gold trading, pip value in oil trading, pip value in stock trading, pip value calculation, pip value calculation formula, pip value calculation chart, pip value calculation table, how to calculate pip value, pip value in pips, pip value per pip, pip value of a trade, pip value of a position, pip value of a lot, pip value of a contract, pip value of a currency, pip value of an instrument, pip value of a market, pip value of a financial product, pip value of a commodity, pip value of a stock market, pip value of a bond market, pip value of a cryptocurrency market, pip value of a futures market, pip value of a options market, pip value calculation method, pip value calculation strategy, pip value calculation technique, pip value calculation tool, pip value calculation software, pip value calculation app, pip value calculation website, pip value calculation online, pip value calculation excel, pip value calculation spreadsheet, pip value calculation in excel, pip value calculation in spreadsheet, pip value calculator online, pip value calculator app, pip value calculator website, pip value calculator excel, pip value calculator spreadsheet, pip value calculator in excel, pip value calculator in spreadsheet, pip value of currency pairs calculator, pip value of gold calculator, pip value of oil calculator, pip value of stock calculator, pip value calculator for currency pairs, pip value calculator for gold, pip value calculator for oil, pip value calculator for stock, pip value calculator for forex, pip value calculator for trading, pip value calculator for currency trading, pip value calculator for forex trading, pip value calculator for gold trading, pip value calculator for oil trading, pip value calculator for stock trading, pip value calculator formula, pip value calculator chart, pip value calculator table, pip value calculator tool, pip value calculator software, pip value calculator app, pip value calculator website, pip value calculator online, pip value calculator excel, pip value calculator spreadsheet, pip value calculator in excel, pip value calculator in spreadsheet">

    <div id="forex-overview" style="font-weight:3px">
        <object data="<?php echo $base_url; ?>/public/widgets/forex-overview" width="100%" height="110" type="text/html"> Forex Overview </object>
    </div>
    <div class="row">
        <?php
        include './../SideBarLeft.php';
        ?>
        <div class="col-lg-3 pl-lg-4 pr-lg-0 mt-sm-minus-20 mb-3">
            <div class="cagr-calulator">
                <h1 style="font-size:24px; text-transform:uppercase">Pip Value Calculator <sup><span class="badge badge-danger font-11 font-weight-normal">Beta</span></sup></h1>
                <strong>Calculate Pip Value</strong>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Trade Size (Lots)</label>
                                    <input class="form-ctrl" type="number" value="1" id="trade-size" placeholder="Enter trade size" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pips</label>
                                    <input class="form-ctrl" type="number" value="1" id="pips" placeholder="Enter pips" required>
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
                                    Price: -- <br>
                                    Pip Value: -- <br>
                                    Standard Lot: -- <br>
                                    Mini Lot: -- <br>
                                    Micro Lot: --
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="about-cagr pt-2">
                <h5 class="mt-2" style="Font-size:17px !important;">Learn more about Pip Value</h5>
                <p class="mt-2">Pip value is the monetary value of a single pip in a currency pair. It is an essential concept for forex traders, as it helps them to determine the potential profit or loss of a trade, and to manage their risk more effectively. The value of a pip can vary depending on the size of the trade and the currency pair being traded. In order to calculate the pip value, traders must first determine the size of their trade, measured in lots. A standard lot is equal to 100,000 units of the base currency, while a mini lot is equal to 10,000 units, and a micro lot is equal to 1,000 units.</p>
                <p class="mt-2">Once the size of the trade has been determined, traders can use the following formula to calculate the pip value:
                    Pip value = (1 pip / exchange rate) * trade size</p>
                <p class="mt-2">For example, if a trader is trading a standard lot of EUR/USD, and the current exchange rate is 1.20, the pip value would be calculated as follows:
                    (0.0001 / 1.20) * 100,000 = 8.33</p>
                <p class="mt-2">This means that for every one pip movement in the exchange rate of EUR/USD, the value of the trade will change by $8.33.</p>
                <p class="mt-2">It's worth noting that for JPY pairs the formula will change slightly to:
                    Pip value = (0.01 / exchange rate) * trade size</p>
                <p class="mt-2">It's also important to note that the currency pair in which the account is denominated will affect the pip value calculation. For example, if an account is denominated in USD, the pip value for a trade in EUR/USD will be different than if the account is denominated in EUR.</p>
                <p class="mt-2">In summary, pip value is a key concept in forex trading that helps traders to determine the potential profit or loss of a trade, and to manage their risk more effectively. It is calculated by multiplying the size of the trade by the exchange rate, and then dividing by the number of pips in the trade. By understanding pip value, traders can make more informed decisions about their trading strategies and position sizes, and can more effectively manage their risk.</p>
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
    const calculateButton = document.getElementById("calculate-button");
    const tradeSizeInput = document.getElementById("trade-size");
    const pipsInput = document.getElementById("pips");
    const result = document.getElementById("result");

    // on button click
    calculateButton.addEventListener("click", event => {
        // prevent the default from submission behaviour
        event.preventDefault();
        // getting value and parsing into float
        const tradeSize = parseFloat(tradeSizeInput.value);
        const pips = parseFloat(pipsInput.value);
        const selectedCurrencyPair = currencyPairSelect.value;
        const selectedAccountCurrency = accountCurrencySelect.value;
        // initializing pip value
        var pip_value = 0;
        var baseCurrency = selectedCurrencyPair.slice(0, 3);
        var quoteCurrency = selectedCurrencyPair.slice(3, 6);
        var pipSize = (quoteCurrency === "JPY") ? 0.01 : 0.0001;
        var if_jpy = (quoteCurrency === "JPY") ? 100 : 1;
        var random = parseFloat(0)

        getRate("USD", quoteCurrency)
            .then((data) => {
                random = data;
            })
            .catch((error) => {
                console.log(error);
            })
        getRate(baseCurrency, quoteCurrency)
            .then((exchangeRate) => {
                if (quoteCurrency === "USD") {
                    pip_value = 10;
                } else if (baseCurrency === "USD") {
                    pip_value = (10 / exchangeRate);
                } else {
                    pip_value = (10 / random);
                }
                pip_value = pip_value * if_jpy * tradeSize;
                let lots = (pip_value / tradeSize) * pips;
                result.style.display = "block";
                if (pip_value === Infinity) {
                    result.innerText = `Price: ${exchangeRate}
            Press the Button Again`;
                } else {
                    result.innerText = `Price: ${exchangeRate}
            Pip Value: ${(pip_value).toFixed(4)} ${selectedAccountCurrency}
            Standard Lot: ${(lots).toFixed(4)}
            Mini Lot: ${(lots/10).toFixed(4)}
            Micro Lot: ${(lots/100).toFixed(4)}`;
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