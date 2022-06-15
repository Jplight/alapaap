<?php
    $get_img = mysqli_query($conn,"SELECT * FROM tbl_user where uid = '$uid' ");
    $s_img = mysqli_fetch_array($get_img);
    $my_image = $s_img['image'];  // Get User Image
?>
          
                    <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                        <div class="container-fluid">
                            <button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button">
                                <i class="fas fa-bars"></i>
                            </button>
                            <ul class="navbar-nav flex-nowrap ms-auto">
                                <li class="nav-item dropdown d-sm-none no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                        <i class="fas fa-search"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                        <form class="me-auto navbar-search w-100">
                                            <div class="input-group">
                                                <input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary py-0" type="button">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <li class="nav-item dropdown no-arrow mx-1">
                                    <?php $notif = mysqli_query($conn,"select * from tbl_pending_request where uid = '$uid' order by date_requested LIMIT 5  "); ?>
                                    <div class="nav-item dropdown no-arrow ">
                                        <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                            <span class="badge bg-danger badge-counter"><?php echo mysqli_num_rows($notif); ?></span>
                                            <i class="fas fa-bell fa-fw fa-lg"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-list shadow-lg animated--grow-in">
                                            <h6 class="dropdown-header border-success bg-success">Notification</h6>
                                            <?php 
                                                foreach($notif as $data):
                                                    if ($data['form_type'] == '1'):
                                                        $form_type = "HCI NEW";
                                                    elseif($data['form_type'] == '1-1'):
                                                        $form_type = "HCI UPDATE";
                                                    elseif($data['form_type'] == '1-2'):
                                                        $form_type = "HCI DELETE";
                                                    elseif($data['form_type'] == '2'):
                                                        $form_type = "Adhoc";
                                                    elseif($data['form_type'] == '3'):
                                                        $form_type = "CPS NEW";
                                                    elseif($data['form_type'] == '3-1'):
                                                        $form_type = "CPS UPDATE";
                                                    elseif($data['form_type'] == '3-2'):
                                                        $form_type = "CPS DELETE";
                                                    elseif($data['form_type'] == '4'):
                                                        $form_type = "BaaS CSRF";
                                                    elseif($data['form_type'] == '4-1'):
                                                        $form_type = "BaaS CRRF";
                                                    endif;
                                            ?>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="me-3">
                                                    <div class="bg-success icon-circle">
                                                        <i class="fas fa-file-alt text-white"></i>
                                                    </div>
                                                </div>
                                                <div class="small">
                                                    <span class="d-block text-muted">
                                                       <?php echo time_elapsed_string('2013-05-01 00:22:35', true); ?>
                                                        <?=date('F d, Y - h:i:s A',strtotime($data['date_requested'])); ?>
                                                    </span>                                                
                                                    You have been request for <span class="fw-bold"><?=$form_type;?></span> with control Number: <span class="fw-bold"><?=$data['control_number']; ?></span>
                                                </div>
                                            </a>
                                            <?php endforeach; ?>
                                            <a class="dropdown-item text-center small text-gray-500" href="#">Show All</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item dropdown no-arrow mx-1">
                                    <?php $UMessage = mysqli_query($conn,"select * from tbl_remarks where uid = '$uid' order by remarks_date LIMIT 5  "); ?>
                                    <div class="nav-item dropdown no-arrow">
                                        <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                        <span class="badge bg-danger badge-counter"><?php echo mysqli_num_rows($UMessage); ?></span>
                                            <i class="fas fa-envelope fa-fw fa-lg"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-list shadow-lg animated--grow-in">
                                            <h6 class="dropdown-header border-success bg-success">Message</h6>
                                            <?php
                                                foreach($UMessage as $comment):
                                            ?>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <div class="dropdown-list-image me-3">
                                                    <img class="rounded-circle" src="assets/img/profile.jpg">
                                                    <div class="bg-success status-indicator"></div>
                                                </div>
                                                <div class="fw-bold">
                                                    <div class="text-truncate">
                                                        <span><?php echo $comment['comments']; ?></span>
                                                    </div>
                                                    <p class="small text-gray-500 mb-0"><?=ucwords($comment['fullname']);?></p>
                                                </div>
                                            </a>
                                            <?php endforeach; ?>
                                            <a class="dropdown-item text-center small text-gray-500" href="#">Show All</a>
                                        </div>
                                    </div>
                                    <div class="shadow dropdown-list dropdown-menu dropdown-menu-end" aria-labelledby="alertsDropdown"></div>
                                </li>
                                <li class="nav-item dropdown no-arrow">
                                    <div class="nav-item dropdown no-arrow">
                                        <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                            <?php if (!empty($sub_role) && strlen($sub_role) != 1): ?>   
                                            <select class="nav-item form-select form-select-sm fw-bold" id="myselect">
                                                <?php if (strpos($sub_role,"1") !== false): ?>
                                                <option value="req" <?php echo strpos($my_role,"1") !== false ? 'selected hidden' :''; ?> >Requestor</option>
                                                <?php endif; ?>
                                                <?php if (strpos($sub_role,"2") !== false): ?>
                                                <option value="appr" <?php echo strpos($my_role,'2') !== false ? 'selected hidden': ''; ?> >Approver</option>
                                                <?php endif; ?>
                                                <?php if (strpos($sub_role,"3") !== false): ?>
                                                <option value="rec"  <?php echo strpos($my_role,'3') !== false ? 'selected hidden': '';  ?> >Reciever</option>
                                                <?php endif; ?>
                                                <?php if (strpos($sub_role,"4") !== false): ?>
                                                <option value="perf" <?php echo strpos($my_role,'4') !== false ? 'selected hidden': '';  ?> >Performer</option>
                                                <?php endif; ?>
                                                <?php if (strpos($sub_role,"5") !== false): ?>
                                                <option value="conf" <?php echo strpos($my_role,'5') !== false ? 'selected hidden': '';  ?> >Confirmer</option>
                                                <?php endif; ?>
                                                <?php if (strpos($sub_role,"5") !== false): ?>
                                                <option value="veri" <?php echo strpos($my_role,'6') !== false ? 'selected hidden': '';  ?> >Verifier</option>
                                                <?php endif; ?>
                                            </select>
                                            <?php else: ?>
                                            <span class="d-none d-lg-inline me-2 text-gray-600 small fw-bold">
                                                <?php echo $my_role == 1 ? 'Requestor': ''; ?>
                                                <?php echo $my_role == 2 ? 'Approver': ''; ?>
                                                <?php echo $my_role == 3 ? 'Receiver': ''; ?>
                                                <?php echo $my_role == 4 ? 'Performer': ''; ?>
                                                <?php echo $my_role == 5 ? 'Confirmer': ''; ?>
                                                <?php echo $my_role == 6 ? 'Verifier': ''; ?>
                                            </span>    
                                            <?php endif; ?>
                                        </a>                                      
                                    </div>
                                </li>
                                <div class="d-none d-sm-block topbar-divider"></div>
                                <li class="nav-item dropdown no-arrow">
                                    <div class="nav-item dropdown no-arrow">
                                        <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                            <span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo ucwords($my_fullname); ?></span>
                                            <img class="border rounded-circle img-profile" src="<?php echo $my_image != null ? $my_image : 'assets/img/profile.jpg';?>">
                                        </a>
                                        <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                            <a class="dropdown-item" href="profile.php">
                                                <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile </a>
<!--                                             <a class="dropdown-item" href="#">
                                                <i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log </a> -->
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="../model/logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout </a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>