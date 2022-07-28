<?php   
    
    if($my_role == 1){
        $notif = mysqli_query($conn,"select * from tbl_notification where uid = '$uid' order by date_requested desc ");
        $count_notif = mysqli_num_rows(mysqli_query($conn,"select * from tbl_notification where uid = '$uid' and isViewed = '0'"));
        $GetView = mysqli_fetch_array($notif);
    }else{
        $notif = mysqli_query($conn,"select * from tbl_pending_request where status = '$my_role' order by date_requested desc");
        $count_notif = mysqli_num_rows($notif);

    }

?>
<div class="nav-item dropdown no-arrow ">
    <div class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
        <form method="POST" id="frm_notif" action="">
            <button type="submit" class="btn shadow-none position-relative" id="btn_notif">
                    <?php if($count_notif > 0):?>
                        <span class="badge bg-danger badge-counter position-absolute swing animated infinite" id="notif_badge" ><?= $count_notif; ?></span>
                    <?php endif; ?>
                    <i class="fas fa-bell fa-fw fa-lg "></i>
            </button>
        </form>
    </div>
    
    <div class="dropdown-menu dropdown-menu-end dropdown-list overflow-auto shadow-lg animated--grow-in" style="max-height: 30rem;" >
        <h6 class="dropdown-header border-success bg-success">Notification</h6>
        <?php if($count_notif < 1): ?>
            <a class="dropdown-item d-flex align-items-center " href="javascript:void(0)">
            <div class="small">
                <span class="fw-bold">No new notification right now!</span>
            </div>
        </a>            
        <?php endif; ?>        
        <?php 
            
            foreach($notif as $data):
                
                if($my_role == '1'){ $NotifName = $data['fullname']; $st = $data['activity']; }
                if($my_role == '2'){ $NotifName = $data['fullname']; $st = "requested"; }
                if($my_role == '3' && $data['form_type'] != '2'){ $NotifName = $data['approver']; $st = 'approved'; }
                if($my_role == '3' && $data['form_type'] == '2'){ $NotifName = $data['fullname']; $st = 'requested'; }
                if($my_role == '4'){ $NotifName = $data['reciever'];  $st = 'received';}
                if($my_role == '5'){ $NotifName = $data['performer']; $st = 'performed';}
                if($my_role == '6'){ $NotifName = $data['verifier']; $st = 'conformed';}

                if($data['form_type'] == '1'){$form_type = 'HCI'; }
                if($data['form_type'] == '1-1'){$form_type = 'HCI UPDATE'; }
                if($data['form_type'] == '1-2'){$form_type = 'HCI DELETE'; }
                if($data['form_type'] == '2'){$form_type = 'Adhoc'; }
                if($data['form_type'] == '3'){$form_type = 'CPS'; }
                if($data['form_type'] == '3-1'){$form_type = 'CPS UPDATE'; }
                if($data['form_type'] == '3-2'){$form_type = 'CPS DELETE'; }
                if($data['form_type'] == '4'){$form_type = 'BaaS CSRF'; }
                if($data['form_type'] == '4-2'){$form_type = 'BaaS CRRF'; }

                if($data['uid'] == $uid){
                    $notification = ucwords($data['fullname']).' has '.$st.' your '.$form_type." request with control number of  ".$form_type."/".$data['control_number'];
                }
                if ($my_role == '2'){
                    $notification = ucwords($NotifName).' has '.$st.' '.$form_type." with control number of ".$form_type."/".$data['control_number'];
                }
                if ($my_role == '3' && $data['form_type'] == '1'){
                    $notification = ucwords($NotifName).' has '.$st.' the '.$form_type." of ".ucwords($data['fullname'])." with control number of ".$form_type."/".$data['control_number'];
                }
                if ($my_role == '3' && $data['form_type'] == '2'){
                    $notification = ucwords($NotifName).' has '.$st.' '.$form_type." with control number of ".$form_type."/".$data['control_number'];
                }
                if ($my_role == '3' && $data['form_type'] != '2'){
                    $notification = ucwords($NotifName).' has '.$st.' the '.$form_type." of ".ucwords($data['fullname'])." with control number of ".$form_type."/".$data['control_number'];
                }
                if ($my_role >= '4' && $my_role <= '6'){
                    $notification = ucwords($NotifName).' has '.$st.' the '.$form_type." of ".ucwords($data['fullname'])." with control number of ".$form_type."/".$data['control_number'];
                }
                           
        ?>

        <a class="dropdown-item d-flex align-items-center " href="javascript:void(0)">
            <div class="me-3">
                <div class="bg-success icon-circle">
                    <i class="fas fa-file-alt text-white"></i>
                </div>
            </div>
            <div class="small ">
                <span class="d-block text-muted"><?=date('F d, Y - h:i:s A',strtotime($data['date_requested'])); ?></span>
                <span class="fw-bold d-block text-muted" ><?=get_time_ago(strtotime($data['date_requested']));?></span>                                                  
                <?=$notification; ?>
            </div>
        </a>
        <?php endforeach; ?>

    </div>
</div>