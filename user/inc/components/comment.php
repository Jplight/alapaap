<div class="table-responsive">
                                <table class="table table-borderless table-sm text-nowrap border border-secondary">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th class="text-center" colspan="3">Remarks</th>
                                        </tr>
                                    </thead>
                                    <?php if (!empty($control_number)): ?>
                                    <tbody class="text-dark align-top">
                                        <?php

                                            $no_comments = '<td colspan="3">This form has no comments!</td>';
                                            $txt_area = '<td colspan="3"><textarea class="form-control text-dark" name="comments" placeholder="Please leave a comments here..." ></textarea></td>';
                                            $hci_remarks = mysqli_query($conn,"SELECT * FROM tbl_remarks where control_number = '$control_number' and form_type = '$form_type' ORDER BY remarks_date ASC ");
                                            $hci_count = mysqli_num_rows($hci_remarks);
                                            if ($hci_count  == true){

                                                while($hci_remarks_rows = mysqli_fetch_array($hci_remarks)):
                                                    $com_id = $hci_remarks_rows['comment_id'];
                                                    $hci_role = $hci_remarks_rows['role'];
                                                    if (($my_role == 1 && $hci_role >=1 && $hci_role <=6) || ($my_role == 2 && $hci_role >=1 && $hci_role <=2) || ($my_role == 3 && $hci_role >=1 && $hci_role <=3) || ($my_role == 4 && $hci_role >=1 && $hci_role <=4) || ($my_role == 5 && $hci_role >=1 && $hci_role <=5) || ($my_role == 6 && $hci_role >=1 && $hci_role <=6) ):
                                                        echo '<td><input type="hidden" name="comment_id" value="'.$com_id.'"></td>';
                                                        echo '<tr>';
                                                        echo '<td width="25%"><span class="fw-bold">'.ucwords($hci_remarks_rows['fullname']).'</span><br><span class="small">'.$hci_remarks_rows['remarks_date'].'</span></td>';
                                                        echo '<td width="75%" colspan="2">'.$hci_remarks_rows['comments'].'</td>';
                                                        echo '</tr>';
                                                    endif;    
                                                endwhile;

                                                if ($my_role == 2 && $app_status == NULL || $my_role == 3 && $rec_status == NULL || $my_role == 4 && $perf_status == NULL || $my_role == 5 && $ver_status == NULL || $my_role == 6 && $ver2_status == NULL){
                                                     echo $txt_area;
                                                }
                                                if ($my_role == 1 && $status == 1 && $revised == NULL) {
                                                    echo $txt_area;
                                                }
                                                if ($my_role == 1 && $status == 0 && $revised == 1){
                                                    echo $txt_area;
                                                }

                                            }else{

                                                if ($my_role == 1 && $status == 1 && $approver_id == NULL) {
                                                    echo $txt_area;
                                                }
                                                if ($my_role == 2 && $app_status == NULL || $my_role == 3 && $rec_status == NULL || $my_role == 4 && $perf_status == NULL || $my_role == 5 && $ver_status == NULL || $my_role == 6 && $ver2_status == NULL){
                                                    echo $txt_area;
                                                }
                                                if ($my_role == 2 && $app_status == 1 || $my_role == 3 && $rec_status == 1 || $my_role == 4 && $perf_status == 1 || $my_role == 5 && $ver_status == 1 || $my_role == 6 && $ver2_status == 1  ) {
                                                    echo $no_comments;
                                                }
                                                if (($my_role == 1 || $my_role ==2 ) && $status == 0 && $app_status == 0) {
                                                    echo $no_comments;
                                                }
                                                if ($my_role == 1 && $status == 2 && $approver_id == NULL) {
                                                    echo $no_comments;
                                                }

                                            }
                                        ?>
                                    </tbody>
                                    <?php endif; ?>
                                    <?php if (empty($control_number)): ?>
                                    <tbody>
                                         <tr>
                                             <td colspan="3">
                                                 <textarea class="form-control text-dark" name="comments" placeholder="Please leave a comments here..."  ></textarea>
                                             </td>
                                         </tr>
                                     </tbody>    
                                    <?php endif; ?>
                                </table>
                            </div>