@extends('admin_panel.main')

@section('page_title' , $page_title)

@section('main_content')

    <section class="content-main" style="max-width:1200px">

        <form method="post"
              action="{{ route(config('constants.ADMIN_PREFIX') . $module_name . '_update') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $data->id }}">
            <div class="content-header">
                <h2 class="content-title">Edit {{ $module_add_title }}</h2>
                <div>
                    <a href="{{ route(config('constants.ADMIN_PREFIX') . $module_name . '_show') }}"
                       class="btn btn-light">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-xl-12 col-lg-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-4">
                                <label for="product_title" class="form-label">Role Title</label>
                                <input value="{{ $data->role_name }}" type="text" class="form-control"
                                       name="role_name" placeholder="Enter role name">
                                @include('admin_panel.includes.single_flash',['input_name' => 'role_name'])
                            </div>
                            <div class="table-responsive">
                                <table
                                    class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                                    <thead>
                                    <tr>
                                        <th class="">Module Name</th>
                                        <th class="">Add</th>
                                        <th class="">Edit</th>
                                        <th class="">Delete</th>
                                        <th class="">View</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($modules as $module)
                                        <tr>
                                            <td>
                                                <p class="mb-0">{{ $module->module_name }}</p>
                                            </td>
                                            <td class="checkbox-column">
                                                <div class="custom-control custom-checkbox checkbox-primary">
                                                    <input
                                                        {{ hasPermission($module->module_slug , $data->role_slug , 'can_add') ? 'checked' : '' }} name="permissions[{{ $module->module_slug }}][can_add]"
                                                        type="checkbox" class="custom-control-input todochkbox"
                                                        id="todo-{{ $module->id }}-add">
                                                    <label class="custom-control-label"
                                                           for="todo-{{ $module->id }}-add"></label>
                                                </div>
                                            </td>
                                            <td class="checkbox-column">
                                                <div class="custom-control custom-checkbox checkbox-primary">
                                                    <input
                                                        {{ hasPermission($module->module_slug , $data->role_slug , 'can_edit') ? 'checked' : '' }} name="permissions[{{ $module->module_slug }}][can_edit]"
                                                        type="checkbox" class="custom-control-input todochkbox"
                                                        id="todo-{{ $module->id }}-edit">
                                                    <label class="custom-control-label"
                                                           for="todo-{{ $module->id }}-edit"></label>
                                                </div>
                                            </td>
                                            <td class="checkbox-column">
                                                <div class="custom-control custom-checkbox checkbox-primary">
                                                    <input
                                                        {{ hasPermission($module->module_slug , $data->role_slug , 'can_delete') ? 'checked' : '' }} name="permissions[{{ $module->module_slug }}][can_delete]"
                                                        type="checkbox" class="custom-control-input todochkbox"
                                                        id="todo-{{ $module->id }}-delete">
                                                    <label class="custom-control-label"
                                                           for="todo-{{ $module->id }}-delete"></label>
                                                </div>
                                            </td>
                                            <td class="checkbox-column">
                                                <div class="custom-control custom-checkbox checkbox-primary">
                                                    <input
                                                        {{ hasPermission($module->module_slug , $data->role_slug , 'can_view') ? 'checked' : '' }} name="permissions[{{ $module->module_slug }}][can_view]"
                                                        type="checkbox" class="custom-control-input todochkbox"
                                                        id="todo-{{ $module->id }}-view">
                                                    <label class="custom-control-label"
                                                           for="todo-{{ $module->id }}-view"></label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </form>
    </section>
@endsection


