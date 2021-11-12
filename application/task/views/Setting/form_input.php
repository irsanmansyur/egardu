
<!-- horizontal Basic Forms Start -->
<div class="pd-20 card-box mb-30">

  <div class="clearfix">
    <div class="pull-left">
      <h4 class="text-blue h4">Form Pengaturan</h4>
    </div>
  </div>

  <?php echo $this->session->flashdata('message');
        echo $this->session->flashdata('upload_error');
  ?>

  <?php echo form_open_multipart('Setting/');?>
  <table>
            <tr style="padding: 10px;">
              <th width="10%">Nama Perusahaan</th>
              <td width="45%">
                <?php
                    echo form_input(array(
                    'name'=>'nama',
                    'id'=>'nama',
                    'class'=>'form-control',
                    'required'=>'required',
                    'value'=>$query->nama_perusahaan
                    ))
                ?>
              </td>
            </tr>

            <tr>
              <th width="10%">Alamat Perusahaan</th>
              <td width="45%">
                <?php
                    echo form_input(array(
                    'name'=>'alamat',
                    'id'=>'alamat',
                    'class'=>'form-control',
                    'required'=>'required',
                    'value'=>$query->alamat
                    ))
                ?>
              </td>
            </tr>

            <tr>
              <th width="10%">No. Telepon</th>
              <td width="45%">
                <?php
                    echo form_input(array(
                    'name'=>'notel',
                    'id'=>'notel',
                    'class'=>'form-control',
                    'required'=>'required',
                    'value'=>$query->no_telp
                    ))
                ?>
              </td>
            </tr>

            <tr>
              <th width="10%">Website</th>
              <td width="45%">
                <?php
                    echo form_input(array(
                    'name'=>'website',
                    'id'=>'website',
                    'class'=>'form-control',
                    'required'=>'required',
                    'value'=>$query->website
                    ))
                ?>
              </td>
            </tr>

            <tr>
              <th width="10%">Email</th>
              <td width="45%">
                <?php
                    echo form_input(array(
                    'type'=>'email',
                    'name'=>'email',
                    'id'=>'email',
                    'class'=>'form-control',
                    'required'=>'required',
                    'value'=>$query->email
                    ))
                ?>
              </td>
            </tr>


            <tr>
              <th width="10%">Background Login </th>
              <td width="45%">
              <?php
                echo form_hidden('backadminlawas',$query->background_admin);
                        if($query->background_admin <> "")
                        {
                                ?>
                                <img src="<?php echo base_url('uploads/pengaturan/'.$query->background_admin);?>" class="img-responsive" width="300">
                                <?php
                        }
                ?>
                    <br>
                    <b>Upload Logo</b>
                    <?php echo form_upload('backgroundadmin',array('class'=>'form-control'))?><br>
                    <span class="label label-info">File yang diijinkan : JPG, JPEG, PNG. Ukuran : 2000x2000 px / 5 MB</span>
              </td>
            </tr>

            <tr>
              <td></th>
              <td></td>
            </tr>
          </table>

          <br>

        <div class="box-footer">
          <button class="btn btn-success" type="submit" name="simpan"><i class="fa fa-check"></i> Simpan Pengaturan</button>
        </div>
  </form>
</div>
<!-- horizontal B	asic Forms End -->
