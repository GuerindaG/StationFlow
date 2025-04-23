<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Codescandy" name="author">
    <title>Gestionnaire de station Service</title>
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/favicon/favicon.ico')}}">

    @include('admin.css')

    @include('admin.js')


</head>

<body>

    <div class="border-bottom">
        @include('admin.header')

        @include('admin.navbar')
    </div>

    <main>

        <div class="mt-8 mb-lg-14 mb-8">

            <div class="container">

                <div class="row gx-10"></div>

                @yield('content-body')

            </div>
        </div>

    </main>

    <!-- Modal -->
    <div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-8">
                    <div class="position-absolute top-0 end-0 me-3 mt-3">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-12 mb-5">
                            <!-- card -->
                            <div class="card h-100 card-lg">
                                <div class="card-body p-6">
                                    <div class="d-md-flex justify-content-between">
                                        <div class="d-flex align-items-center mb-2 mb-md-0">
                                            <h2 class="mb-0">Rapport #FC001</h2>
                                            <span class="badge bg-light-warning text-dark-warning ms-2">Statut</span>
                                        </div>
                                        <!-- select option -->
                                        <div class="d-md-flex">
                                            <div class="mb-2 mb-md-0">
                                                <h2 class="mb-0">Date rapport</h2>
                                            </div>
                                            <!-- button -->
                                            <div class="ms-md-3">
                                                <a href="#" class="btn btn-primary">Valider</a>
                                                <a href="#" class="btn btn-secondary">Télécharger</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-8">
                                        <div class="row">
                                            <!-- address -->
                                            <div class="col-lg-4 col-md-4 col-12">
                                                <div class="mb-6">
                                                    <h6>Informations Générales</h6>
                                                    <p class="mb-1 lh-lg">
                                                        Nom station
                                                        <br />
                                                        emailstation
                                                        <br />
                                                        telephone
                                                    </p>
                                                    <a href="#">Voir Profile</a>
                                                </div>
                                            </div>
                                            <!-- address -->
                                            <div class="col-lg-4 col-md-4 col-12">
                                                <div class="mb-6">
                                                    <h6>Shipping Address</h6>
                                                    <p class="mb-1 lh-lg">
                                                        Gerg Harvell
                                                        <br />
                                                        568, Suite Ave.
                                                        <br />
                                                        Austrlia, 235153
                                                        <br />
                                                        Contact No. +91 99999 12345
                                                    </p>
                                                </div>
                                            </div>
                                            <!-- address -->
                                            <div class="col-lg-4 col-md-4 col-12">
                                                <div class="mb-6">
                                                    <h6>Order Details</h6>
                                                    <p class="mb-1 lh-lg">
                                                        Order ID:
                                                        <span class="text-dark">FC001</span>
                                                        <br />
                                                        Order Date:
                                                        <span class="text-dark">October 22, 2023</span>
                                                        <br />
                                                        Order Total:
                                                        <span class="text-dark">$734.28</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <!-- Table -->
                                            <table class="table mb-0 text-nowrap table-centered">
                                                <!-- Table Head -->
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>Products</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <!-- tbody -->
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <a href="#" class="text-inherit">
                                                                <div class="d-flex align-items-center">
                                                                    <div>
                                                                        <img src="../assets/images/products/product-img-1.jpg"
                                                                            alt="" class="icon-shape icon-lg" />
                                                                    </div>
                                                                    <div class="ms-lg-4 mt-2 mt-lg-0">
                                                                        <h5 class="mb-0 h6">Haldiram's Sev Bhujia</h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td><span class="text-body">$18.0</span></td>
                                                        <td>1</td>
                                                        <td>$18.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="#" class="text-inherit">
                                                                <div class="d-flex align-items-center">
                                                                    <div>
                                                                        <img src="../assets/images/products/product-img-2.jpg"
                                                                            alt="" class="icon-shape icon-lg" />
                                                                    </div>
                                                                    <div class="ms-lg-4 mt-2 mt-lg-0">
                                                                        <h5 class="mb-0 h6">NutriChoice Digestive</h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td><span class="text-body">$24.0</span></td>
                                                        <td>1</td>
                                                        <td>$24.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="#" class="text-inherit">
                                                                <div class="d-flex align-items-center">
                                                                    <div>
                                                                        <img src="../assets/images/products/product-img-3.jpg"
                                                                            alt="" class="icon-shape icon-lg" />
                                                                    </div>
                                                                    <div class="ms-lg-4 mt-2 mt-lg-0">
                                                                        <h5 class="mb-0 h6">Cadbury 5 Star Chocolate
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td><span class="text-body">$32.0</span></td>
                                                        <td>1</td>
                                                        <td>$32.0</td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="#" class="text-inherit">
                                                                <div class="d-flex align-items-center">
                                                                    <div>
                                                                        <img src="../assets/images/products/product-img-4.jpg"
                                                                            alt="" class="icon-shape icon-lg" />
                                                                    </div>
                                                                    <div class="ms-lg-4 mt-2 mt-lg-0">
                                                                        <h5 class="mb-0 h6">Onion Flavour Potato</h5>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td><span class="text-body">$3.0</span></td>
                                                        <td>2</td>
                                                        <td>$6.0</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-bottom-0 pb-0"></td>
                                                        <td class="border-bottom-0 pb-0"></td>
                                                        <td colspan="1" class="fw-medium text-dark">
                                                            <!-- text -->
                                                            Sub Total :
                                                        </td>
                                                        <td class="fw-medium text-dark">
                                                            <!-- text -->
                                                            $80.00
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-bottom-0 pb-0"></td>
                                                        <td class="border-bottom-0 pb-0"></td>
                                                        <td colspan="1" class="fw-medium text-dark">
                                                            <!-- text -->
                                                            Shipping Cost
                                                        </td>
                                                        <td class="fw-medium text-dark">
                                                            <!-- text -->
                                                            $10.00
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="1" class="fw-semibold text-dark">
                                                            <!-- text -->
                                                            Grand Total
                                                        </td>
                                                        <td class="fw-semibold text-dark">
                                                            <!-- text -->
                                                            $90.00
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-6">
                                    <div class="row">
                                        <div class="col-md-6 mb-4 mb-lg-0">
                                            <h6>Payment Info</h6>
                                            <span>Cash on Delivery</span>
                                        </div>
                                        <div class="col-md-6">
                                            <h5>Notes</h5>
                                            <textarea class="form-control mb-3" rows="3"
                                                placeholder="Write note for order"></textarea>
                                            <a href="#" class="btn btn-primary">Save Notes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.footer')

</body>

</html>