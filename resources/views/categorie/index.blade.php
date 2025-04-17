@extends('Admin.LayoutAdmin')
@section('content-body')

    <div class="container">
        <div class="row mb-8">
            <div class="col-md-12">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                    <div>
                        <h2>Inventaire des produits</h2>
                    </div>
                    <ul class="nav nav-pills justify-content-center mb-6 bg-white border d-inline-flex rounded-3 p-2"
                        id="myTab" role="tablist">
                        <!-- nav item -->
                        <li class="nav-item" role="presentation">
                            <!-- btn -->
                            <button class="nav-link active" id="address-tab" data-bs-toggle="tab"
                                data-bs-target="#address-tab-pane" type="button" role="tab" aria-controls="address-tab-pane"
                                aria-selected="true">
                                Catégories
                            </button>
                        </li>
                        <!-- nav item -->
                        <li class="nav-item" role="presentation">
                            <!-- btn -->
                            <button class="nav-link" id="payment-tab" data-bs-toggle="tab"
                                data-bs-target="#payment-tab-pane" type="button" role="tab" aria-controls="payment-tab-pane"
                                aria-selected="false">
                                Produits
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">

                <!-- tab content -->
                <div class="tab-content" id="myTabContent">
                    <!-- tab pane -->
                    <div class="tab-pane fade show active" id="address-tab-pane" role="tabpanel"
                        aria-labelledby="address-tab" tabindex="0">
                        <div class="card h-100 card-lg">
                            <div class="p-6">
                                <div class="d-flex justify-content-between flex-row align-items-center">
                                    <div>
                                        <h3 class="mb-0 h6">Catégories</h3>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#address">Nouvelle catégorie</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table
                                        class="table table-centered table-hover table-borderless mb-0 table-with-checkbox text-nowrap">
                                        <thead class="bg-light">
                                            <tr class="text-center">
                                                <th>
                                                    N°
                                                </th>
                                                <th>Nom</th>
                                                <th>Date de Création</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-center">
                                                <td>1</td>
                                                <td>123 Elm St.</td>
                                                <td>IL</td>
                                                <td>
                                                    <div class="d-flex text-end">
                                                        <a href="#" class="btn btn-primary shadow btn-xs sharp me-2"><i
                                                                class="bi bi-pencil-square "></i></a>
                                                        <form action="#" method="POST"
                                                            onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette station ?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger shadow btn-xs sharp">
                                                                <i class="bi bi-trash"></i>
                                                            </button>
                                                        </form>

                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="border-top d-md-flex justify-content-between align-items-center p-6">
                                    <span>Showing 1 result</span>
                                    <nav class="mt-2 mt-md-0">
                                        <ul class="pagination mb-0">
                                            <li class="page-item disabled"><a class="page-link" href="#!">Previous</a></li>
                                            <li class="page-item"><a class="page-link active" href="#!">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#!">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#!">Next</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- tab pane -->
                    <div class="tab-pane fade" id="payment-tab-pane" role="tabpanel" aria-labelledby="payment-tab"
                        tabindex="0">
                        <div class="card h-100 card-lg">
                            <div class="p-6">
                                <div class="d-flex justify-content-between flex-row align-items-center">
                                    <div>
                                        <h3 class="mb-0 h6">Payments</h3>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#payment">New Payment</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table
                                        class="table table-centered table-hover table-borderless mb-0 table-with-checkbox text-nowrap">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="paymentOne" />
                                                        <label class="form-check-label" for="paymentOne"></label>
                                                    </div>
                                                </th>
                                                <th>Order ID</th>
                                                <th>Transaction Id</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Method</th>
                                                <th>Status</th>
                                                <th>
                                                    <div class="dropdown">
                                                        <a href="#" class="text-reset" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="feather-icon icon-more-vertical fs-5"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="bi bi-trash me-3"></i>
                                                                    Delete
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="bi bi-pencil-square me-3"></i>
                                                                    Edit
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="paymentTwo" />
                                                        <label class="form-check-label" for="paymentTwo"></label>
                                                    </div>
                                                </td>

                                                <td>#101</td>

                                                <td>TXN001</td>
                                                <td>17 May, 2023 at 3:18pm</td>
                                                <td>$34.00</td>
                                                <td>Credit Card</td>
                                                <td><span class="badge bg-light-success text-dark-success">Completed</span>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" class="text-reset" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="feather-icon icon-more-vertical fs-5"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="bi bi-trash me-3"></i>
                                                                    Delete
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="bi bi-pencil-square me-3"></i>
                                                                    Edit
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="paymentThree" />
                                                        <label class="form-check-label" for="paymentThree"></label>
                                                    </div>
                                                </td>

                                                <td>#102</td>

                                                <td>TXN002</td>
                                                <td>17 May, 2023 at 3:18pm</td>
                                                <td>$34.00</td>
                                                <td>PayPal</td>
                                                <td><span class="badge bg-light-warning text-dark-warning">Pending</span>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" class="text-reset" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="feather-icon icon-more-vertical fs-5"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="bi bi-trash me-3"></i>
                                                                    Delete
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="bi bi-pencil-square me-3"></i>
                                                                    Edit
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="paymentFour" />
                                                        <label class="form-check-label" for="paymentFour"></label>
                                                    </div>
                                                </td>

                                                <td>#103</td>

                                                <td>TXN003</td>
                                                <td>17 May, 2023 at 3:18pm</td>
                                                <td>$34.00</td>
                                                <td>Debit Card</td>
                                                <td><span class="badge bg-light-danger text-dark-danger">Failed</span></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" class="text-reset" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="feather-icon icon-more-vertical fs-5"></i>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="bi bi-trash me-3"></i>
                                                                    Delete
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="#">
                                                                    <i class="bi bi-pencil-square me-3"></i>
                                                                    Edit
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="border-top d-md-flex justify-content-between align-items-center p-6">
                                    <span>Showing 1 result</span>
                                    <nav class="mt-2 mt-md-0">
                                        <ul class="pagination mb-0">
                                            <li class="page-item disabled"><a class="page-link" href="#!">Previous</a></li>
                                            <li class="page-item"><a class="page-link active" href="#!">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#!">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#!">Next</a></li>
                                        </ul>
                                    </nav>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="address" data-bs-backdrop="static" data-bs-keyboard="false"
                                    tabindex="-1" aria-labelledby="addressLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content p-6 d-flex flex-column gap-6">
                                            <div class="d-flex flex-row align-items-center justify-content-between">
                                                <h5 class="modal-title" id="addressLabel">Create address</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-0">
                                                <form class="row needs-validation g-3" novalidate>
                                                    <div class="col-lg-6 col-12">
                                                        <!-- input -->
                                                        <label for="customerEditAdd" class="form-label">Street</label>
                                                        <input type="text" class="form-control" id="customerEditAdd"
                                                            placeholder="Street Address" required />
                                                        <div class="invalid-feedback">Please enter address</div>
                                                    </div>

                                                    <div class="col-lg-6 col-12">
                                                        <!-- input -->
                                                        <label for="customerZip" class="form-label">Zip Code</label>
                                                        <input type="text" class="form-control" id="customerZip"
                                                            placeholder="Enter Zip" required />
                                                        <div class="invalid-feedback">Please enter zip</div>
                                                    </div>

                                                    <div class="col-lg-6 col-12">
                                                        <!-- input -->
                                                        <label for="customerCity" class="form-label">City</label>
                                                        <input type="text" class="form-control" id="customerCity"
                                                            placeholder=" City" required />
                                                        <div class="invalid-feedback">Please enter city</div>
                                                    </div>
                                                    <div class="col-lg-6 col-12">
                                                        <!-- input -->
                                                        <label for="customerCity" class="form-label">State</label>
                                                        <input type="text" class="form-control" id="customerState"
                                                            placeholder=" State" required />
                                                        <div class="invalid-feedback">Please enter state</div>
                                                    </div>
                                                    <div class="col-lg-8 col-12">
                                                        <label for="customerCountry" class="form-label">Country</label>
                                                        <select class="form-select" id="customerCountry" required>
                                                            <option selected disabled value="">Country</option>
                                                            <option value="India">India</option>
                                                            <option value="UK">UK</option>
                                                            <option value="USA">USA</option>
                                                        </select>
                                                        <div class="invalid-feedback">Please select a valid state.</div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="d-flex flex-row gap-3">
                                                <button type="button" class="btn btn-primary">Create</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
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
    </div>

@endsection