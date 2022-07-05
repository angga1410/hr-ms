@extends('layouts.app', [
'class' => '',
'elementActive' => 'admin'
])

@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="container">

            </div>

            <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header border-bottom-0">
                            <h5 class="modal-title" id="exampleModalLabel">Create Document Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form>
        <div class="modal-body">
      
      
          <div class="form-group">
            <label for="email1">Name</label>
            <input type="email" class="form-control" id="email1" aria-describedby="emailHelp" >
           
          </div>
          
      
        
      
        
        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
          <button type="submit" class="btn btn-success">Submit</button>
        </div>
      </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Document Category List</h4>
                    <h4 class="card-title text-right"> <button class="btn btn-info" data-toggle="modal" data-target="#form" title="Add !"><i class="nc-icon nc-simple-add"></i></button> </h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th>
                                Name
                                </th>
                               
                                <th>
                                    Action
                                </th>
                            </thead>
                            <tbody>
                                <tr>
                               
                                    <td>
                                        Dakota Rice
                                    </td>
                                    <td>
                                        <i class="nc-icon nc-settings-gear-65"></i>
                                    </td>
                                </tr>
                                <tr>
                                   
                                 
                                    <td>
                                        Dakota Rice
                                    </td>
                                    <td>
                                        <i class="nc-icon nc-settings-gear-65"></i>
                                    </td>
                                </tr>
                                <tr>
                                    

                                    <td>
                                        Dakota Rice
                                    </td>
                                    <td>
                                        <i class="nc-icon nc-settings-gear-65"></i>
                                    </td>
                                </tr>
                                <tr>
                                
                                    
                                    <td>
                                        Dakota Rice
                                    </td>
                                    <td>
                                        <i class="nc-icon nc-settings-gear-65"></i>
                                    </td>
                                </tr>
                                <tr>
                                 
                                    <td>
                                        Dakota Rice
                                    </td>
                                    <td>
                                        <i class="nc-icon nc-settings-gear-65"></i>
                                    </td>
                                </tr>
                                <tr>
                                    
                                 
                                    <td>
                                        Dakota Rice
                                    </td>
                                    <td>
                                        <i class="nc-icon nc-settings-gear-65"></i>
                                    </td>
                                </tr>
                                <tr>
                                  
                                    <td>
                                        Dakota Rice
                                    </td>
                                    <td>
                                        <i class="nc-icon nc-settings-gear-65"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection