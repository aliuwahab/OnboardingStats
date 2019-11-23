
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Dashboard Temper</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


</head>
<body class="col-md-12">
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Temper</a>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="#">Sign out</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">
                            <span data-feather="home"></span>
                            Dashboard <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard">
                            <span data-feather="file"></span>
                            Onboarding Curve
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main id="app" role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 container">

            <br><br><br>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Onboarding Flow User Progression (Curve)</h1>
            </div>


            <div id="chartArea">
                <highcharts :options="chartOptions" ref="highcharts"></highcharts>
            </div>

            <br><br><br>

            <hr>

            <h2>Onboarding Flow User Progression (Tabular)</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Week</th>

                        <th v-for="(step) in onboardingStats.categories">Step {{ step }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(weeklydata) in onboardingStats.series">
                        <td>{{weeklydata.name}}</td>
                        <td v-for="(percentage) in weeklydata.data">{{percentage }} %</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <br>
    <br>
    <br>
</div>

<!--External dependencies jquery, vue and axios-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.13/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.js"></script>

<script src="https://cdn.jsdelivr.net/npm/highcharts@6/highcharts.js"></script>
<!-- vue-highcharts should be load after Highcharts -->
<script src="https://cdn.jsdelivr.net/npm/vue-highcharts/dist/vue-highcharts.min.js"></script>

<script src="/js/dashboard.js"></script>

</body>
</html>




