@extends('layout.master')
@section('title','Settings')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="py-3 mb-4"><span class="text-muted fw-light">Settings</span></h4>
  <div class="row">
      <div class="col-xl">
          <div class="card mb-4">
          <div class="card-header d-flex justify-content-between align-items-center">
              <h5 class="mb-0">Your Settings</h5>
              <small class="text-muted float-end"></small>
          </div>
          <div class="card-body">
              <form method="POST" action="{{route('clients.settings.update')}}">
                  @csrf
                  <div class="row">
                    <div class="col-md-12">
                      <div class="demo-vertical-spacing">
                        <label class="switch switch-lg">
                          <input type="hidden" name="is_show_educational" value="0">
                          <input type="checkbox" class="switch-input" name="is_show_educational" value="1" {{ $tenant->is_show_educational ? 'checked' : '' }}/>
                          <span class="switch-toggle-slider">
                            <span class="switch-on">
                              <i class="ti ti-check"></i>
                            </span>
                            <span class="switch-off">
                              <i class="ti ti-x"></i>
                            </span>
                          </span>
                          <span class="switch-label">Show educational section in portfolio ?</span>
                        </label>
                      </div>
                      @error('is_show_educational')
                          <div class="invalid-feedback text-sm">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-md-12">
                      <div class="demo-vertical-spacing">
                        <label class="switch switch-lg">
                          <input type="hidden" name="is_show_experience" value="0">
                          <input type="checkbox" class="switch-input" name="is_show_experience" value="1" {{ $tenant->is_show_experience ? 'checked' : '' }}/>
                          <span class="switch-toggle-slider">
                            <span class="switch-on">
                              <i class="ti ti-check"></i>
                            </span>
                            <span class="switch-off">
                              <i class="ti ti-x"></i>
                            </span>
                          </span>
                          <span class="switch-label">Show experience section in portfolio ?</span>
                        </label>
                      </div>
                      @error('is_show_experience')
                          <div class="invalid-feedback text-sm">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-md-12">
                      <div class="demo-vertical-spacing">
                        <label class="switch switch-lg">
                          <input type="hidden" name="is_show_language" value="0">
                          <input type="checkbox" class="switch-input" name="is_show_language" value="1" {{ $tenant->is_show_language ? 'checked' : '' }}/>
                          <span class="switch-toggle-slider">
                            <span class="switch-on">
                              <i class="ti ti-check"></i>
                            </span>
                            <span class="switch-off">
                              <i class="ti ti-x"></i>
                            </span>
                          </span>
                          <span class="switch-label">Show language section in portfolio ?</span>
                        </label>
                      </div>
                      @error('is_show_language')
                          <div class="invalid-feedback text-sm">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-md-12">
                      <div class="demo-vertical-spacing">
                        <label class="switch switch-lg">
                          <input type="hidden" name="is_show_skill" value="0">
                          <input type="checkbox" class="switch-input" name="is_show_skill" value="1" {{ $tenant->is_show_skill ? 'checked' : '' }}/>
                          <span class="switch-toggle-slider">
                            <span class="switch-on">
                              <i class="ti ti-check"></i>
                            </span>
                            <span class="switch-off">
                              <i class="ti ti-x"></i>
                            </span>
                          </span>
                          <span class="switch-label">Show skill section in portfolio ?</span>
                        </label>
                      </div>
                      @error('is_show_skill')
                          <div class="invalid-feedback text-sm">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-md-12">
                      <div class="demo-vertical-spacing">
                        <label class="switch switch-lg">
                          <input type="hidden" name="is_show_project" value="0">
                          <input type="checkbox" class="switch-input" name="is_show_project" value="1" {{ $tenant->is_show_project ? 'checked' : '' }}/>
                          <span class="switch-toggle-slider">
                            <span class="switch-on">
                              <i class="ti ti-check"></i>
                            </span>
                            <span class="switch-off">
                              <i class="ti ti-x"></i>
                            </span>
                          </span>
                          <span class="switch-label">Show project section in portfolio ?</span>
                        </label>
                      </div>
                      @error('is_show_project')
                          <div class="invalid-feedback text-sm">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-md-12">
                      <div class="demo-vertical-spacing">
                        <label class="switch switch-lg">
                          <input type="hidden" name="is_show_link" value="0">
                          <input type="checkbox" class="switch-input" name="is_show_link" value="1" {{ $tenant->is_show_link ? 'checked' : '' }}/>
                          <span class="switch-toggle-slider">
                            <span class="switch-on">
                              <i class="ti ti-check"></i>
                            </span>
                            <span class="switch-off">
                              <i class="ti ti-x"></i>
                            </span>
                          </span>
                          <span class="switch-label">Show link section in portfolio ?</span>
                        </label>
                      </div>
                      @error('is_show_link')
                        <div class="invalid-feedback text-sm">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-md-12">
                      <div class="demo-vertical-spacing">
                        <label class="switch switch-lg">
                          <input type="hidden" name="is_show_contact" value="0">
                          <input type="checkbox" class="switch-input" name="is_show_contact" value="1" {{ $tenant->is_show_contact ? 'checked' : '' }}/>
                          <span class="switch-toggle-slider">
                            <span class="switch-on">
                              <i class="ti ti-check"></i>
                            </span>
                            <span class="switch-off">
                              <i class="ti ti-x"></i>
                            </span>
                          </span>
                          <span class="switch-label">Show contact section in portfolio ?</span>
                        </label>
                      </div>
                      @error('is_show_contact')
                        <div class="invalid-feedback text-sm">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-md-12">
                      <div class="demo-vertical-spacing">
                        <label class="switch switch-lg">
                          <input type="hidden" name="is_show_download_cv" value="0">
                          <input type="checkbox" class="switch-input" name="is_show_download_cv" value="1" {{ $tenant->is_show_download_cv ? 'checked' : '' }}/>
                          <span class="switch-toggle-slider">
                            <span class="switch-on">
                              <i class="ti ti-check"></i>
                            </span>
                            <span class="switch-off">
                              <i class="ti ti-x"></i>
                            </span>
                          </span>
                          <span class="switch-label">Show download full CV (PDF) section in portfolio ?</span>
                        </label>
                      </div>
                      @error('is_show_download_cv')
                        <div class="invalid-feedback text-sm">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="col-md-12">
                      <div class="demo-vertical-spacing">
                        <label class="switch switch-lg">
                          <input type="hidden" name="is_show_website" value="0">
                          <input type="checkbox" class="switch-input" name="is_show_website" value="1" {{ $tenant->is_show_website ? 'checked' : '' }}/>
                          <span class="switch-toggle-slider">
                            <span class="switch-on">
                              <i class="ti ti-check"></i>
                            </span>
                            <span class="switch-off">
                              <i class="ti ti-x"></i>
                            </span>
                          </span>
                          <span class="switch-label">Show online website section in portfolio ?</span>
                        </label>
                      </div>
                      @error('is_show_website')
                        <div class="invalid-feedback text-sm">{{ $message }}</div>
                      @enderror
                    </div>
                </div>
                <br>
                  <div class="form-group row">
                      <div class="col-sm-10">
                          <button type="submit" class="btn btn-primary mt-3">Update</button>
                      </div>
                  </div>
              </form>
          </div>
          </div>
      </div>
  </div>
</div>
@endsection