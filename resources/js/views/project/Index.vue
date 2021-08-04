<template>
  <div>
  <!-- start page title -->
  <div class="row">
   <div class="col-12">
      <div class="page-title-box">
         <div class="page-title-left">
            <ol class="breadcrumb m-0">
               <li class="breadcrumb-item"><a href=""><i class="remixicon-home-8-line"></i></a></li>
               <li class="breadcrumb-item active">Dự án</li>
            </ol>
         </div>
      </div>
   </div>
   <Message :success="success" :error="error" ></Message>
</div>
<div class="row">
    <div class="col-12">
    </div>
</div>
<!-- end page title --> 
<div class="row">
   <div class="col-12">
      <div class="card">
        <div class="card-header d-inline-flex justify-content-between py-1">
            <h4 class="card-title d-inline-block mb-0 py-1">Danh sách dự án
              <span class="text-success fs-15 ml-1">(Note - TT: Tình trạng)</span>
            </h4>
        </div>

         <div class="card-body">
            <div id="basic-datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
               <div class="row">
                  <div class="col-sm-12">
                    <div class="table-responsive">
                     <table id="basic-datatable" class="table table-striped dt-responsive nowrap dataTable no-footer dtr-inline" role="grid" aria-describedby="basic-datatable_info" >
                        <thead>
                           <tr role="row">
                              
                              <th width="3%" class="text-center">STT</th>
                              <th class="text-center"width="20%">Dự án</th>
                              <th width="15%" class="text-center">TT hợp đồng</th>
                              <th width="15%" class="text-center">TT lập trình</th>
                              <th width="10%" class="text-center">Dev phụ trách</th>
                              <th width="10%" class="text-center">Saler</th>
                              <!-- <th width="15%" class="text-center">Ngày tạo</th> -->
                              <th width="10%"  class="text-center">Hành động</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr >
                             <tr v-for="project in listProjects.data" :key="project.id" role="row" class="even">  
                              <td align="center">
                               1
                              </td>
                              <td align="center"><a href="">{{project.name}}</a></td>
                              <td align="center">
                                <a v-for="status_code in project.status_code">
                                  {{status_code.name}}
                                </a>
                              </td>
                              <td align="center">
                                <a v-for="status_project in project.status_project">
                                   {{status_project.name}}
                                </a>
                              </td>
                              <td align="center">
                                <a v-for="dev in project.dev">
                                   {{dev.name}}
                                </a>
                              </td>
                              <td align="center">
                                <a v-for="saler in project.saler">
                                   {{saler.name}}
                                </a>
                            </td>

                              

                              <td align="center">
                                <div class="d-flex">
                                  <a href="" 
                                    title="Xem dự án"
                                    class="btn btn-icon waves-effect waves-light btn-purple">
                                    <i class="mdi mdi-eye"></i>
                                  </a>
                                  <!-- <a href="" 
                                    class="btn btn-icon waves-effect waves-light btn-info ml-1">
                                    <i class="mdi mdi-send-circle"></i>
                                  </a> -->
                                  <a href="#" 
                                    data-url=""
                                    data-id=""
                                    class="delete-item btn btn-icon waves-effect waves-light btn-danger ml-1" 
                                    >
                                    <i class="mdi mdi-close"></i>
                                  </a>
                                </div>
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
   </div>
  </div>
  </div>
</template>

<script>
  import Message from '../../components/MessagesComponent.vue'
   export default {
       data() {
           return {
              listProjects: [],
              error: null,
              success: null,
           }
       },
       created() {
         this.getListProjects()
         this.success = this.$route.query.success
       },

       methods: {

           async getListProjects() {

                try {
                   const response = await axios.get('/api/project')
                   this.listProjects = response.data[0]
                }catch (error) {
                   this.error = error.response.data
                }
           }   
       },
       components: {
            Message,
        }
   }
</script>


<style type="text/css">
	
</style>