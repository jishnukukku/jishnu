<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Trending Cases</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center mb-4">Trending Cases</h2>

    <?php
    
    function callAPI($url, $params) {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return false; 
        }

        curl_close($ch);

        return json_decode($response, true);
    }

   
    $apiUrl = 'http://devapi.hidoc.co:8080/TrendingPastCases/PastCases?action=getTrendingCasesCP';
    $params = array(
        'userId' => 586,
        'lastCount' => 0,
        'searchKeyword' => 'Cance',
    );

   
    $response = callAPI($apiUrl, $params);

   
    if ($response) {

        foreach ($response as $cases) {
            if (is_array($cases)) {
                foreach ($cases as $case) {

                    
                    echo '<div class="card">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">Case Title: ' . $case['case_type'] . '</h5>';
                    echo '<p class="card-text">Admin Name: ' . $case['admin'] . '</p>';
                        if (!empty($case['case_url'])) {
                          echo '<img src="' . $case['case_url'] . '" class="img-fluid mb-3" alt="Case Image">';
                        }
                        else{
                          echo '<img src="' . $case['image'] . '" class="img-fluid mb-3" alt="Case Image">';
                            

                        }
                        if(!empty($case['createdat']))
                        {
                          echo '<p class="card-text">Created Date: ' . $case['createdat'] . '</p>';
                        }
                    echo '</div>';
                    echo '</div>';
                }
            }
        }
    } else {
        echo '<div class="alert alert-danger mt-4" role="alert">';
        echo 'API call failed or returned invalid data.';
        echo '</div>';
    }
    ?>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
