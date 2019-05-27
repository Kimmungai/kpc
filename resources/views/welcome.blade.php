@extends('layouts.kpc')

@section('content')

			<!-- /pages_agile_info_w3l -->

						<div class="pages_agile_info_w3l">
							<!-- /login -->
							   <div class="over_lay_agile_pages_w3ls">
								    <div class="registration">

												<div class="signin-form profile">
													<h2>{{env('APP_NAME')}}</h2>
													<div class="login-form">
														<form action="{{ route('login') }}" method="post">
                              @csrf
															<input type="email" id="email" name="email" placeholder="E-mail" required="">

															<input type="password" id="password" name="password" placeholder="Password" required="">

                              <div class="red-text">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

															<div class="tp">
																<input type="submit" value="LOG IN">
															</div>


														</form>
													</div>

													<p><a href="#"> Sign in to get started</a></p>

													 <h6><a href="#">Administrator: 0790-xxx-xxx</a><h6>
												</div>
										</div>
										<!--copy rights start here-->
											<div class="copyrights_agile">
											</div>
											<!--copy rights end here-->
						    </div>
						</div>
							<!-- /login -->
<!-- //pages_agile_info_w3l -->
@endsection
