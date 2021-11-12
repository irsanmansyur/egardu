<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/app/css/style.css">
<?php if ($this->session->flashdata('message')) { ?>
<div class="col-lg-12 alerts">
    <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4> <i class="icon fa fa-ban"></i> Error</h4>
        <p><?php echo $this->session->flashdata('message'); ?></p>
    </div>
</div>
<?php } else {
} ?>
<section class="content">
    <div class="row">
        <div class='col-xs-12'>
            <div class='box box-primary'>
                <div class='box-header  with-border'>
                    <h3 class='box-title'>New Request Transport</h3>
                </div>
                <div class="box-body">
                    <?php echo form_open_multipart('Approval_ga_supervisor/checkup/' . $id, array('role' => "form", 'id' => "myForm", 'data-toggle' => "validator")); ?>
                    <input type="hidden" name="id-x" value="<?php echo $id ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-8">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input type="radio" name="status" value="approved" id="approved" required/>
                                        <label for="approved" class="control-label">Approve</label>&nbsp;&nbsp;&nbsp;
                                        <?php if($approval == null): ?>
                                            <input type="radio" name="status" value="rejected" id="rejected" required/>
                                            <label for="rejected" class="control-label">Reject</label>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-8">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="vehicle" class="control-label">Pilih Driver
                                        </label>
                                        <div class="input-group">
                                            <select class="form-control" name="drop_driver" <?= $disabled ?>>
                                                <?php if ($statdriver == 1) { ?>
                                                <?php
                                                    foreach ($driver as $k) {
                                                        $seledted = '';
                                                        if ($k->id_driver == $data->id_vehicle) {
                                                            $seledted = 'selected';
                                                        }
                                                        echo "<option value=' $k->id_driver' >$k->nama_driver</option>";
                                                    }
                                                    ?>
                                                <?php } else { ?>
                                                <option value="-">Tidak Butuh Driver</option>
                                                <?php } ?>
                                            </select>
                                            <span class="input-group-addon">
                                                <span class="fa fa-list"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="vehicle" class="control-label">Pilih Mobil</label>
                                        <select class="form-control" name="drop_plat">
                                            <?php
                                            foreach ($vehicle as $k) {
                                                $status = '(Available)';
                                                $disabled = '';
                                                if ($k->available == 1) {
                                                    $status  = '(Occupied)';
                                                    $disabled = 'disabled';
                                                }


                                                echo "<option value=' $k->id_vehicle' $disabled>$k->plat_nomor - $k->merk_mobil -taksi online $status</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>

                    </div>
                    <div class="row">
                        <!-- <div class="col-md-12">
                            <div class="col-md-8">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="vehicle" class="control-label">Jenis Taksi </label>
                                        <div class="input-group">
                                            <select class="form-control" name="drop_taksi">
                                            <?php
                                            $stoptak = '';
                                            $nontak = '';
                                            if ($data->id_taksi == 1) {
                                                $stoptak = 'selected';
                                            } elseif ($data->id_taksi == 0) {

                                                $nontak = 'selected';
                                            }

                                            ?>
                                                <option value='0' <?php echo $nontak; ?>> Non - Taksi</option>
                                                <option value='1' <?php echo $stoptak; ?>>Taksi</option>
                                            </select>
                                            <span class="input-group-addon">
                                                <span class="fa fa-list"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                    <div class="help-block with-errors"></div>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-8">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="vehicle" class="control-label">Note</label>
                                        <div class="input-group">
                                            <textarea class="form-control" name="noted" id="" cols="30" rows="10"
                                                value=""> <?php echo $data->note ?></textarea>
                                            <span class="input-group-addon">
                                                <span class="fa fa-comments-o"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4 offset-8">
                                <div class="box-footer">
                                    <button type="submit" name="submit" class="btn btn-primary ">Simpan</button>
                                    <a href="<?php echo base_url() ?>Approval_ga_supervisor"
                                        class="btn btn-default ">Cancel</a>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
    </div>
    </div>
</section>
