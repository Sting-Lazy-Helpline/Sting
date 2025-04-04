<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sting Live Report</title>
    <link rel="shortcut icon" href="{{ asset('theme/assets/media/logos/logom3.jpg')}}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('theme/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/assets/plugins/custom/jkanban/jkanban.bundle.css')}}" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('admin_dashboard_assets/js/bootstrap.bundle.min.js') }}"></script>

    <style>
        html {
            font-family: Inter, Helvetica, sans-serif;
        }
    </style>
</head>

<body>

    <main>
        <header class="mb-3 border-bottom h-25" >
            <div class="container-fluid d-grid gap-3 align-items-center pb-3 pt-4 p-3">
                <img alt="Logo" src="{{ asset('theme/assets/media/logos/logolong.jpg')}}" class="theme-light-show h-60px" />
            </div>
        </header>

        <!-- Today's Date and Last Updated -->
        <div class="container-fluid text-center my-4">
            <h4 id="todayDate" class="text-primary">Today: {{ date('D M d Y') }}</h4>
            <p id="lastUpdated" class="text-muted">Last updated at: {{ date('H:i') }}</p>
        </div>

        <!-- Main Content -->
        <div class="app-main__inner dashboard360 container-fluid">
            <div class="card border rounded my-3 shadow-sm my-3">
                <div class="card-body border-0 rounded">

                    <div class="table-responsive">
                        <table class="table table-hover border-left-0 border-right-0 font-600 display1">
                            <thead>
                                <tr>
                                    <th>Agent name</th>
                                    <th>Total Talk Time </th>
                                    <th>Total Break Time</th>
                                    <th>Total Calls</th>
                                    <th>Abandoned Calls</th>
                                    <th>Drop Calls</th>
                                    <th>On Break</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Asad</td>
                                    <td>10</td>
                                    <td>24</td>
                                    <td>77</td>
                                    <td>99</td>
                                    <td>885</td>
                                    <td>13</td>
                                </tr>
                                <tr>
                                    <td>Dawn</td>
                                    <td>10</td>
                                    <td>24</td>
                                    <td>77</td>
                                    <td>99</td>
                                    <td>885</td>
                                    <td>13</td>
                                </tr>
                                <tr>
                                    <td>Talha</td>
                                    <td>10</td>
                                    <td>24</td>
                                    <td>77</td>
                                    <td>99</td>
                                    <td>885</td>
                                    <td>13</td>
                                </tr>
                            </tbody>
                            <tfoot class="table-light">
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </main>
    {{-- <script>
        function fetchAndUpdateTable() {
            fetch('/liveAgentData')
                .then(response => response.json())
                .then(data => {
                    updateTable(data.productivity);
                    updateLastUpdated(); // Update "Last Updated" time after each fetch
                });
        }

        fetchAndUpdateTable();

        setInterval(fetchAndUpdateTable, 5000);

        function updateTable(productivity) {
            let tableBody = document.querySelector('tbody');
            let totalCalls = 0;
            let abonSum = 0;
            let dropSum = 0;

            tableBody.innerHTML = '';

            productivity.forEach(item => {
                totalCalls += item.total_calls || 0;
                abonSum += item.abandoned_calls || 0;
                dropSum += item.drop_calls || 0;

                tableBody.innerHTML += `
                    <tr>
                        <td>${item.agent_name}</td>
                        <td>${formatTime(item.total_talk_time)}</td>
                        <td>${formatTime(item.break_time)}</td>
                        <td>${item.total_calls}</td>
                        <td>${item.abandoned_calls}</td>
                        <td>${item.drop_calls}</td>
                        <td>${item.is_on_break ? '<span class="text-danger">Yes</span>' : '<span class="text-success">No</span>'}</td>
                    </tr>
                `;
            });

            let tableFoot = document.querySelector('tfoot');
            tableFoot.innerHTML = `
                <tr>
                    <th colspan="3">Total</th>
                    <td>${totalCalls}</td>
                    <td>${abonSum}</td>
                    <td>${dropSum}</td>
                    <td></td>
                </tr>
            `;
        }

        function formatTime(seconds) {
            const date = new Date(0);
            date.setSeconds(seconds);
            return date.toISOString().substr(11, 8);
        }

        function updateLastUpdated() {
            const now = new Date();
            document.getElementById('lastUpdated').innerText = 'Last updated at: ' + now.toLocaleTimeString();
        }

        // Display today's date
        function displayTodayDate() {
            const today = new Date();
            document.getElementById('todayDate').innerText = 'Today: ' + today.toDateString();
        }

        // Initial date display
        displayTodayDate();
    </script> --}}

</body>
{{-- <div class="ms-3" style="position: fixed;
    height: 5rem;
    bottom: 0;
    width: 100%;">
    <div class="login-footer w-100 row justify-content-center justify-content-lg-between align-items-baseline"
        bis_skin_checked="1">
        <div class="app-footer col-lg-4 col-8" bis_skin_checked="1">
            <img src="{{ asset('theme/assets/media/logos/logolong.jpg')}}" class="w-100 mt-3">
        </div>
    </div>
</div> --}}

</html>