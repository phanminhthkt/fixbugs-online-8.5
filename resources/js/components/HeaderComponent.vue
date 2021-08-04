<template>
	<div>
		<div class="navbar-custom">
		    <ul class="list-unstyled topnav-menu float-right mb-0">
		        <li class="d-none d-sm-block">
		            <form class="app-search">
		                <div class="app-search-box">
		                    <div class="input-group">
		                        <input type="text" class="form-control" placeholder="Search...">
		                        <div class="input-group-append">
		                            <button class="btn" type="submit">
		                                <i class="fe-search"></i>
		                            </button>
		                        </div>
		                    </div>
		                </div>
		            </form>
		        </li>
		        <li class="dropdown notification-list">
		            <a class="nav-link dropdown-toggle  waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
		                <i class="fe-bell noti-icon"></i>
		                <span class="badge badge-danger rounded-circle noti-icon-badge">4</span>
		            </a>
		            <div class="dropdown-menu dropdown-menu-right dropdown-lg">

		                <!-- item-->
		                <div class="dropdown-item noti-title">
		                    <h5 class="m-0">
		                        <span class="float-right">
		                            <a href="" class="text-dark">
		                                <small>Clear All</small>
		                            </a>
		                        </span>Notification
		                    </h5>
		                </div>

		                <div class="slimscroll noti-scroll">

		                    <!-- item-->
		                    <a href="javascript:void(0);" class="dropdown-item notify-item active">
		                        <div class="notify-icon bg-soft-primary text-primary">
		                            <i class="mdi mdi-comment-account-outline"></i>
		                        </div>
		                        <p class="notify-details">Doug Dukes commented on Admin Dashboard
		                            <small class="text-muted">1 min ago</small>
		                        </p>
		                    </a>
		                    <!-- item-->
		                    <a href="javascript:void(0);" class="dropdown-item notify-item">
		                        <div class="notify-icon bg-secondary">
		                            <i class="mdi mdi-heart"></i>
		                        </div>
		                        <p class="notify-details">Carlos Crouch liked
		                            <b>Admin</b>
		                            <small class="text-muted">13 days ago</small>
		                        </p>
		                    </a>
		                </div>

		                <!-- All-->
		                <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
		                    View all
		                    <i class="fi-arrow-right"></i>
		                </a>

		            </div>
		        </li>
		        <li class="dropdown notification-list">
		            <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
		                <img src="frontend\images\users\avatar-1.jpg" alt="user-image" class="rounded-circle">
		                <span class="pro-user-name ml-1">
		                	{{userObject.username}}
		                    <i class="mdi mdi-chevron-down"></i> 
		                </span>
		            </a>
		            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
		                <!-- item-->
		                <router-link to="/project" class="dropdown-item notify-item">
		                    <i class="remixicon-account-circle-line"></i>
		                    <span>Thông tin cá nhân</span>
		                </router-link>	
		                <a href="/logout" class="dropdown-item notify-item">
		                    <i class="remixicon-logout-box-line"></i>
		                    <span>Đăng xuất</span>
		                </a>

		            </div>
		        </li>
		    </ul>
		    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
		        <li>
		            <button class="button-menu-mobile waves-effect waves-light">
		                <i class="fe-menu"></i>
		            </button>
		        </li>

		        <li class="dropdown d-none d-lg-block">
		            <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false" >
		                Quản lí dự án
		                <i class="mdi mdi-chevron-down"></i> 
		            </a>
		            <div class="dropdown-menu"
		            	>
		                <!-- item-->

		                <router-link :to="{ name: 'project.add'}"  class="dropdown-item">	
		                    <i class="fe-briefcase mr-1"></i>
		                    <span>Khởi tạo dự án</span>
		                </router-link>
		                <!-- item-->
		                <router-link :to="{ name: 'project.index'}" class="dropdown-item">
		                    <i class="fe-list mr-1"></i>
		                    <span>Danh sách dự án</span>
		                </router-link>
		                <!-- item-->
		                <a href="javascript:void(0);" class="dropdown-item">
		                    <i class="fe-bar-chart-line- mr-1"></i>
		                    <span>Xem thống kê</span>
		                </a>
		            </div>
		        </li>
		    </ul>
		</div>
	</div>
</template>

<script>
    export default {
    	props:['user'],
        data() {
            return{
                userObject:JSON.parse(this.$props.user)
            }
        },
    }
</script>

<style lang="scss" scoped>
	
</style>