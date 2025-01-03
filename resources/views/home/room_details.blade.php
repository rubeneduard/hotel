<!DOCTYPE html>
<html lang="en">

<head>
    @include('home.css')

    <style type="text/css">
        label {
            display: inline-block;
            width: 100%;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            margin-bottom: 20px;
        }
    </style>

</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Header Start -->
        @include('home.header')
        <!-- Header End -->

        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="section-title text-center text-primary text-uppercase">Our Rooms</h6>
                    <h1 class="mb-5">Explore Our <span class="text-primary text-uppercase">Rooms</span></h1>
                </div>

                <div class="row g-4">
                    <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="room-item shadow rounded overflow-hidden">
                            <div class="position-relative" style="padding: 20px">
                                <img class="img-fluid" style="height: 300px; width: 800px" src="/room/{{$room->image}}"
                                    alt="">
                            </div>
                            <div class="p-4 mt-2">
                                <div class="d-flex justify-content-between mb-3">
                                    <h3 class="mb-0">{{$room->room_title}}</h3>
                                </div>

                                <p style="padding: 12px">{{$room->description}}</p>

                                <h6 style="padding: 12px">Free wifi : {{$room->wifi}}</h6>
                                <h6 style="padding: 12px">Room Type : {{$room->room_type}}</h6>
                                <h6 style="padding: 12px"> Price: ₱{{$room->price}}</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-container">
                            <h1 style="font-size: 30px; margin-bottom: 20px;">Book Room</h1>

                            @if ($errors)
                            @foreach ($errors->all() as $errors)
                            <div class="error-message">{{$errors}}</div>
                            @endforeach
                            @endif

                            <form action="{{url('add_booking', $room->id)}}" method="Post">
                                @csrf
                                <div>
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" @if (Auth::check()) value="{{ Auth::user()->name }}" @endif>
                                </div>

                                <div>
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" @if (Auth::check()) value="{{ Auth::user()->email }}" @endif>
                                </div>

                                <div>
                                    <label for="phone">Phone</label>
                                    <input type="number" name="phone" id="phone" @if (Auth::check()) value="{{ Auth::user()->phone }}" @endif>
                                </div>

                                <div>
                                    <label for="startDate">Start Date</label>
                                    <input type="date" name="startDate" id="startDate">
                                </div>

                                <div>
                                    <label for="endDate">End Date</label>
                                    <input type="date" name="endDate" id="endDate">
                                </div>

                                <div>
                                    <label for="payment-method">Payment Method</label>
                                    <select id="payment-method" class="form-control" onchange="togglePaymentButton()" required>
                                        <option value="">Select Payment Method</option>
                                        <option value="pay-at-hotel">Pay at Hotel</option>
                                        <option value="pay-online">Pay Online</option>
                                    </select>
                                </div>
                                <input type="hidden" name="payment_status" id="payment-status">
                                <input type="hidden" name="status" id="status">

                                <div>
                                    <input type="submit" class="btn btn-primary" value="Book Room">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br><br><br>

        <!-- Footer Start -->
        @include('home.footer')
        <!-- Footer End -->

        <!-- Back to Top -->
        @include('home.script')

        <script type="text/javascript">
            $(function(){
                var dtToday = new Date();

                var month = dtToday.getMonth() + 1;
                var day = dtToday.getDate();
                var year = dtToday.getFullYear();

                if(month < 10)
                    month = '0' + month.toString();
                if(day < 10)
                    day = '0' + day.toString();

                var maxDate = year + '-' + month + '-' + day;
                $('#startDate').attr('min', maxDate);
                $('#endDate').attr('min', maxDate);

                // Set the current date as the default value for the start date
                $('#startDate').val(maxDate);
            });

            function togglePaymentButton() {
                var paymentMethod = document.getElementById('payment-method').value;
                var paymentStatusInput = document.getElementById('payment-status');
                var statusInput = document.getElementById('status');
                if (paymentMethod === 'pay-at-hotel') {
                    paymentStatusInput.value = "pay-at-hotel";
                } else if (paymentMethod === 'pay-online') {
                    paymentStatusInput.value = "pay-online";
                    openPaymentTab();
                }
            }

            function openPaymentTab() {
                var url = "{{ url('pay', ['id' => $room->id]) }}";
                var width = 600;
                var height = 400;
                var left = (screen.width - width) / 2;
                var top = (screen.height - height) / 2;
                window.open(url, '_blank', 'width=' + width + ',height=' + height + ',top=' + top + ',left=' + left);
            }
        </script>

</body>

</html>
