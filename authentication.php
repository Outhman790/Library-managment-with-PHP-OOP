<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Font Awesome -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
      rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
      rel="stylesheet"
    />
    <!-- MDB -->
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css"
      rel="stylesheet"
    />
    <!-- MDB -->
    <script
      defer
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"
    ></script>

    <title>Document</title>
  </head>
  <body>
    <section class="h-100 bg-dark">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col">
            <div class="card card-registration my-4">
              <div class="row g-0">
                <div class="col-xl-6 d-none d-xl-block">
                  <img
                    src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/img4.webp"
                    alt="Sample photo"
                    class="img-fluid"
                    style="
                      border-top-left-radius: 0.25rem;
                      border-bottom-left-radius: 0.25rem;
                    "
                  />
                </div>
                <div class="col-xl-6">
                  <div class="card-body p-md-5 text-black">
                    <h3 class="mb-5 text-uppercase">
                      Student registration form
                    </h3>

                    <div class="row">
                      <div class="col-md-6 mb-4">
                        <div class="form-outline">
                          <input
                            type="text"
                            id="form3Example1m"
                            class="form-control form-control-lg"
                          />
                          <label class="form-label" for="form3Example1m"
                            >Nickname</label
                          >
                        </div>
                      </div>
                      <div class="col-md-6 mb-4">
                        <div class="form-outline">
                          <input
                            type="text"
                            id="form3Example1n"
                            class="form-control form-control-lg"
                          />
                          <label class="form-label" for="form3Example1n"
                            >CIN</label
                          >
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 mb-4">
                        <div class="form-outline">
                          <input
                            type="text"
                            id="form3Example1m1"
                            class="form-control form-control-lg"
                          />
                          <label class="form-label" for="form3Example1m1"
                            >Adress</label
                          >
                        </div>
                      </div>
                      <div class="col-md-6 mb-4">
                        <div class="form-outline">
                          <input
                            type="number"
                            id="form3Example1n1"
                            class="form-control form-control-lg"
                          />
                          <label class="form-label" for="form3Example1n1"
                            >Phone number</label
                          >
                        </div>
                      </div>
                    </div>

                    <div class="form-outline mb-4">
                      <input
                        type="email"
                        id="form3Example8"
                        class="form-control form-control-lg"
                      />
                      <label class="form-label" for="form3Example8"
                        >Email</label
                      >
                    </div>

                    <div
                      class="d-md-flex justify-content-start align-items-center mb-4 py-2"
                    >
                      <h6 class="mb-0 me-4">Gender:</h6>

                      <div class="form-check form-check-inline mb-0 me-4">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="inlineRadioOptions"
                          id="femaleGender"
                          value="option1"
                        />
                        <label class="form-check-label" for="femaleGender"
                          >Female</label
                        >
                      </div>

                      <div class="form-check form-check-inline mb-0 me-4">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="inlineRadioOptions"
                          id="maleGender"
                          value="option2"
                        />
                        <label class="form-check-label" for="maleGender"
                          >Male</label
                        >
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6 mb-4">
                        <select class="select">
                          <option value="1">State</option>
                          <option value="2">Option 1</option>
                          <option value="3">Option 2</option>
                          <option value="4">Option 3</option>
                        </select>
                      </div>
                      <div class="col-md-6 mb-4">
                        <select class="select">
                          <option value="1">City</option>
                          <option value="2">Option 1</option>
                          <option value="3">Option 2</option>
                          <option value="4">Option 3</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-outline mb-4">
                      <input
                        type="text"
                        id="form3Example9"
                        class="form-control form-control-lg"
                      />
                      <label class="form-label" for="form3Example9">DOB</label>
                    </div>

                    <div class="form-outline mb-4">
                      <input
                        type="text"
                        id="form3Example90"
                        class="form-control form-control-lg"
                      />
                      <label class="form-label" for="form3Example90"
                        >Pincode</label
                      >
                    </div>

                    <div class="form-outline mb-4">
                      <input
                        type="text"
                        id="form3Example99"
                        class="form-control form-control-lg"
                      />
                      <label class="form-label" for="form3Example99"
                        >Course</label
                      >
                    </div>

                    <div class="form-outline mb-4">
                      <input
                        type="text"
                        id="form3Example97"
                        class="form-control form-control-lg"
                      />
                      <label class="form-label" for="form3Example97"
                        >Email ID</label
                      >
                    </div>

                    <div class="d-flex justify-content-end pt-3">
                      <button type="button" class="btn btn-light btn-lg">
                        Reset all
                      </button>
                      <button type="button" class="btn btn-warning btn-lg ms-2">
                        Submit form
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>