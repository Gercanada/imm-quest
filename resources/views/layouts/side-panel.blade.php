<!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="side-mini-panel">
            <a class="inner-toggle d-none d-md-block" href="javascript:void(0)" id="toggle-stylish-sidebar"><i
                    class="ti-menu"></i></a>
            <ul class="mini-nav">
                <li class="">
                    <a href="javascript:void(0)"><i data-feather="home" class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <a href="{{route('dashboard')}}"></a>
                        <h3 class="menu-title">Dashboard</h3>
                        <!-- Left navbar-header -->
                        {{-- <ul class="sidebar-menu">
                            <li><a href="index.html">Minimal</a></li>
                            <li><a href="index2.html">Demographical</a></li>
                            <li><a href="index3.html">Analytical</a></li>
                            <li><a href="index4.html">Modern</a></li>
                        </ul> --}}
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li class=""><a href="javascript:void(0)"><i data-feather="clipboard"
                            class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <a href="{{route('cases')}}"></a>
                        <h3 class="menu-title">Cases</h3>
                        <ul class="sidebar-menu">
                            <li><a href="layout-inner-fixed-left-sidebar.html">Active cases</a></li>
                            <li><a href="layout-inner-fixed-right-sidebar.html">Pending cases</a></li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li class=""><a href="javascript:void(0)"><i data-feather="crosshair"
                            class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">Check lists</h3>
                        <ul class="sidebar-menu">
                            <li><a href="app-calendar.html">Calendar</a></li>
                            <li><a href="app-chats.html">Chat app</a></li>
                            <li><a href="app-contacts.html">Contacts</a></li>
                            <li><a href="app-invoice.html">Invoice</a></li>
                            <li><a href="app-notes.html">Notes</a></li>
                            <li><a href="app-todo.html">Todo</a></li>
                            <li><a href="app-taskboard.html">Taskboard</a></li>

                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li class=""><a href="javascript:void(0)"><i data-feather="mail"
                            class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">Quotes</h3>
                        <ul class="sidebar-menu">
                            <li><a href="inbox-email.html">Email Detail</a></li>
                            <li><a href="inbox-email-detail.html">Email Compose</a></li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li class=""><a href="javascript:void(0)"><i data-feather="bookmark"
                            class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">Invoices</h3>
                        <ul class="sidebar-menu">
                            <li><a href="ticket-list.html">Ticket List</a></li>
                            <li><a href="ticket-detail.html">Ticket Detail</a></li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li><a href="javascript:void(0)"><i data-feather="cpu" class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">Payments</h3>
                        <ul class="sidebar-menu">
                            <li><a href="ui-buttons.html">Payments history</a></li>
                            <li><a href="ui-modals.html">Make a payment</a></li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li><a href="javascript:void(0)"><i data-feather="copy" class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">Comm board</h3>
                        <ul class="sidebar-menu">
                            <li><a href="ui-cards.html">Basic Cards</a></li>
                            <li><a href="ui-card-customs.html">Custom Cards</a></li>
                            <li><a href="ui-card-weather.html">Weather Cards</a></li>
                            <li><a href="ui-card-draggable.html">Draggable Cards</a></li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                {{-- <li><a href="javascript:void(0)"><i data-feather="hard-drive" class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">Documents</h3>
                        <ul class="sidebar-menu">
                            <li><a href="component-sweetalert.html">Sweet Alert</a></li>
                            <li><a href="component-nestable.html">Nestable</a></li>
                            <li><a href="component-noui-slider.html">Noui slider</a></li>
                            <li><a href="component-rating.html">Rating</a></li>
                            <li><a href="component-toastr.html">Toastr</a></li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li><a href="javascript:void(0)"><i data-feather="grid" class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">Widgets</h3>
                        <ul class="sidebar-menu">
                            <li><a href="widgets-apps.html">Apps Widgets</a></li>
                            <li><a href="widgets-data.html">Data Widgets</a></li>
                            <li><a href="widgets-charts.html">Charts Widgets</a></li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li><a href="javascript:void(0)"><i data-feather="layers" class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">Form Elements</h3>
                        <ul class="sidebar-menu">
                            <li><a href="form-inputs.html">Forms Input</a></li>
                            <li><a href="form-input-groups.html">Input Groups</a></li>
                            <li><a href="form-input-grid.html">Input Grid</a></li>
                            <li><a href="form-checkbox-radio.html">Checkboxes &amp; Radios</a></li>
                            <li><a href="form-bootstrap-touchspin.html">Bootstrap Touchspin</a></li>
                            <li><a href="form-bootstrap-switch.html">Bootstrap Switch</a></li>
                            <li><a href="form-select2.html">Select2</a></li>
                            <li><a href="form-dual-listbox.html">Dual Listbox</a></li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li><a href="javascript:void(0)"><i data-feather="file-text" class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">Form Layouts</h3>
                        <ul class="sidebar-menu">
                            <li><a href="form-basic.html">Basic Form</a></li>
                            <li><a href="form-horizontal.html">Form Horizontal</a></li>
                            <li><a href="form-actions.html">Form Actions</a></li>
                            <li><a href="form-row-separator.html">Row Separator</a></li>
                            <li><a href="form-bordered.html">Form Bordered</a></li>
                            <li><a href="form-striped-row.html">Striped Rows</a></li>
                            <li><a href="form-detail.html">Form detail</a></li>
                            <li><a href="form-material.html">Form Material</a></li>
                            <li><a href="form-floating-input.html">Form Floating Input</a></li>
                            <li><a href="form-wizard.html">Form Wizard</a></li>
                            <li><a href="form-repeater.html">Form Repeater</a></li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li><a href="javascript:void(0)"><i data-feather="package" class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">Form Addons</h3>
                        <ul class="sidebar-menu">
                            <li><a href="form-paginator.html">Paginator</a></li>
                            <li><a href="form-img-cropper.html">Image Cropper</a></li>
                            <li><a href="form-dropzone.html">Dropzone</a></li>
                            <li><a href="form-mask.html">Form Mask</a></li>
                            <li><a href="form-typeahead.html">Form Typehead</a></li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li><a href="javascript:void(0)"><i data-feather="check-square" class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">Form Validation</h3>
                        <ul class="sidebar-menu">
                            <li><a href="form-bootstrap-validation.html">Bootstrap Validation</a></li>
                            <li><a href="form-custom-validation.html">Custom Validation</a></li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li><a href="javascript:void(0)"><i data-feather="droplet" class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">Form Pickers</h3>
                        <ul class="sidebar-menu">
                            <li><a href="form-picker-colorpicker.html">Form Colorpicker</a></li>
                            <li><a href="form-picker-datetimepicker.html">Form Datetimepicker</a></li>
                            <li><a href="form-picker-bootstrap-rangepicker.html">Form Bootstrap Rangepicker</a></li>
                            <li><a href="form-picker-bootstrap-datepicker.html">Form Bootstrap Datepicker</a></li>
                            <li><a href="form-picker-material-datepicker.html">Form Material Datepicker</a></li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li><a href="javascript:void(0)"><i data-feather="edit" class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">Form Editor</h3>
                        <ul class="sidebar-menu">
                            <li><a href="form-editor-ckeditor.html">Ck Editor</a></li>
                            <li><a href="form-editor-quill.html">Quill Editor</a></li>
                            <li><a href="form-editor-summernote.html">Summernote Editor</a></li>
                            <li><a href="form-editor-tinymce.html">Tinymce Editor</a></li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li class=""><a href="javascript:void(0)"><i data-feather="codepen"
                            class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">Tables</h3>
                        <ul class="sidebar-menu">
                            <li><a href="table-basic.html">Basic Tables</a></li>
                            <li><a href="table-dark-basic.html">Dark Basic Tables</a></li>
                            <li><a href="table-sizing.html">Sizing Table</a></li>
                            <li><a href="table-layout-coloured.html">Coloured Table Layout</a></li>
                            <li><a href="table-jsgrid.html">Js Grid</a></li>
                            <li><a href="table-responsive.html">Table Responsive</a></li>
                            <li><a href="table-footable.html">Table Footable</a></li>
                            <li><a href="table-editable.html">Table Editable</a></li>
                            <li><a href="table-bootstrap.html">Table Bootstrap</a></li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li class=""><a href="javascript:void(0)"><i data-feather="hard-drive"
                            class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">DataTables</h3>
                        <ul class="sidebar-menu">
                            <li><a href="table-datatable-basic.html">Basic Initialisation</a></li>
                            <li><a href="table-datatable-api.html">API Initialisation</a></li>
                            <li><a href="table-datatable-advanced.html">Advanced Initialisation</a></li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li class=""><a href="javascript:void(0)"><i data-feather="loader"
                            class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">Charts</h3>
                        <ul class="sidebar-menu">
                            <li><a href="chart-morris.html">Morris Chart</a></li>
                            <li><a href="chart-flot.html">Flot Chart</a></li>
                            <li><a href="chart-chart-js.html">ChartJs</a></li>
                            <li><a href="chart-sparkline.html">Sparkline Chart</a></li>
                            <li><a href="chart-chartist.html">Chartist Chart</a></li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li class=""><a href="javascript:void(0)"><i data-feather="bar-chart-2"
                            class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">C3 Charts</h3>
                        <ul class="sidebar-menu">
                            <li><a href="chart-morris.html">Axis Chart</a></li>
                            <li><a href="chart-flot.html">Bar Chart</a></li>
                            <li><a href="chart-chart-js.html">Data Chart</a></li>
                            <li><a href="chart-sparkline.html">Line Chart</a></li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li class=""><a href="javascript:void(0)"><i data-feather="pie-chart"
                            class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">Echarts</h3>
                        <ul class="sidebar-menu">
                            <li><a href="chart-echart-basic.html">Basic Chart</a></li>
                            <li><a href="chart-echart-bar.html">Bar Chart</a></li>
                            <li><a href="chart-echart-pie-doughnut.html">Pie &amp; Doughnut Chart</a></li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li class=""><a href="javascript:void(0)"><i data-feather="shopping-cart"
                            class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">Ecommerce Pages</h3>
                        <ul class="sidebar-menu">
                            <li><a href="eco-products.html">Products</a></li>
                            <li><a href="eco-products-cart.html">Products Cart</a></li>
                            <li><a href="eco-products-edit.html">Products Edit</a></li>
                            <li><a href="eco-products-detail.html">Product Details</a></li>
                            <li><a href="eco-products-orders.html">Product Orders</a></li>
                            <li><a href="eco-products-checkout.html">Products Checkout</a></li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li class=""><a href="javascript:void(0)"><i data-feather="book-open"
                            class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">Sample Pages</h3>
                        <ul class="sidebar-menu">
                            <li><a href="starter-kit.html">Starter Kit</a></li>
                            <li><a href="pages-animation.html">Animation</a></li>
                            <li class="menu"><a href="javascript:void(0)">Authentication<i
                                        class="mdi mdi-chevron-left float-right"></i> </a>
                                <ul class="sub-menu">
                                    <li><a href="authentication-login1.html">Login 1</a></li>
                                    <li><a href="authentication-login2.html">Login 2</a></li>
                                    <li><a href="authentication-register1.html">Register</a></li>
                                    <li><a href="authentication-register2.html">Register 2</a></li>
                                    <li><a href="authentication-lockscreen.html">Lockscreen</a></li>
                                    <li><a href="authentication-recover-password.html">Recover password</a></li>
                                </ul>
                            </li>
                            <li><a href="pages-search-result.html">Search Result</a></li>
                            <li><a href="pages-gallery.html">Gallery</a></li>
                            <li><a href="pages-treeview.html">Treeview</a></li>
                            <li><a href="pages-block-ui.html">Block UI</a></li>
                            <li><a href="pages-session-timeout.html">Session Timeout</a></li>
                            <li><a href="pages-session-idle-timeout.html">Session Idle Timeout</a></li>
                            <li><a href="pages-utility-classes.html">Helper Classes</a></li>
                            <li><a href="pages-maintenance.html">Maintenance Page</a></li>

                            <li class="menu"><a href="javascript:void(0)">Error Pages<i
                                        class="mdi mdi-chevron-left float-right"></i></a>
                                <ul class="sub-menu">
                                    <li><a href="error-400.html">400</a></li>
                                    <li><a href="error-403.html">403</a></li>
                                    <li><a href="error-404.html">404</a></li>
                                    <li><a href="error-500.html">500</a></li>
                                    <li><a href="error-503.html">503</a></li>
                                </ul>
                            </li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li class=""><a href="javascript:void(0)"><i data-feather="users"
                            class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">Users</h3>
                        <ul class="sidebar-menu">
                            <li><a href="ui-user-card.html">User Card</a></li>
                            <li><a href="pages-profile.html">User Profile</a></li>
                            <li><a href="ui-user-contacts.html">User Contact</a></li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li class=""><a href="javascript:void(0)"><i data-feather="paperclip"
                            class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">Invoice</h3>
                        <ul class="sidebar-menu">
                            <li><a href="pages-invoice.html">Invoice Layout</a></li>
                            <li><a href="pages-invoice-list.html">Invoice List</a></li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li class=""><a href="javascript:void(0)"><i class="mdi mdi-map-marker"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">Maps</h3>
                        <ul class="sidebar-menu">
                            <li><a href="map-google.html">Google Map</a></li>
                            <li><a href="map-vector.html">Vector Map</a></li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li class=""><a href="javascript:void(0)"><i data-feather="map"
                            class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">Icons</h3>
                        <ul class="sidebar-menu">
                            <li><a href="icon-material.html">Material Icons</a></li>
                            <li><a href="icon-fontawesome.html">Fontawesome Icons</a></li>
                            <li><a href="icon-themify.html">Themify Icons</a></li>
                            <li><a href="icon-weather.html">Weather Icons</a></li>
                            <li><a href="icon-simple-lineicon.html">Simple Lineicons</a></li>
                            <li><a href="icon-flag.html">Flag Icons</a></li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li class=""><a href="javascript:void(0)"><i data-feather="activity"
                            class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">Timeline</h3>
                        <ul class="sidebar-menu">
                            <li><a href="timeline-center.html">Center Timeline</a></li>
                            <li><a href="timeline-horizontal.html">Horizontal Timeline</a></li>
                            <li><a href="timeline-left.html">Left Timeline</a></li>
                            <li><a href="timeline-right.html">Right Timeline</a></li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li class=""><a href="javascript:void(0)"><i data-feather="mail"
                            class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">Email Template</h3>
                        <ul class="sidebar-menu">
                            <li><a href="email-templete-alert.html">Alert</a></li>
                            <li><a href="email-templete-basic.html">Basic</a></li>
                            <li><a href="email-templete-billing.html">Billing</a></li>
                            <li><a href="email-templete-password-reset.html">Password-Reset</a></li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li>
                <li class=""><a href="javascript:void(0)"><i data-feather="corner-down-left"
                            class="feather-icon"></i></a>
                    <div class="sidebarmenu">
                        <!-- Left navbar-header -->
                        <h3 class="menu-title">Multi Level</h3>
                        <ul class="sidebar-menu">
                            <li><a href="#">item 1.1</a></li>
                            <li><a href="#">item 1.2</a></li>
                            <li class="menu"><a href="#">Menu 1.3<i
                                        class="mdi mdi-chevron-left float-right"></i></a>
                                <ul class="sub-menu">
                                    <li><a href="#">item 1.3.1</a></li>
                                    <li><a href="#">item 1.3.2</a></li>
                                    <li><a href="#">item 1.3.3</a></li>
                                    <li><a href="#">item 1.3.4</a></li>
                                </ul>
                            </li>
                            <li><a href="#">item 1.4</a></li>
                        </ul>
                        <!-- Left navbar-header end -->
                    </div>
                </li> --}}
            </ul>
        </div>
