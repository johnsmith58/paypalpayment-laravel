<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div id="paypal-button"></div>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
        paypal.Button.render({
            env: 'sandbox',
            clinet: {
                sandbox: 'AbZhIif_VQ7cdEn3uPzRzY0bekRvUya280xF8A8pyklEfgNtLSPxwEGhrywLKpf_JKoltGhdzPaf6y3g',
                production: 'demo_production_client_id',
            },
            locale: 'en_US',
            style: {
                size: 'small',
                color: 'gold',
                shape: 'pill',
            },
            payment: function(data, actions){
                return actions.payment.create({
                    transactions: [{
                        amount: {
                            total: '0.01',
                            currency: 'USD'
                        }
                    }]
                });
            },
            onAuthorize: function(data, actions){
                return actions.payment.execute().then(function(){
                    window.alert('Thank you for your pruchase');
                });
            }
        }, '#paypal-button');
    </script>
</body>
</html>