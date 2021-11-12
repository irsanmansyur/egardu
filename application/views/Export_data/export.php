
<table border="1" cellpadding="8">
  <tbody>



  </tbody>
</table>
<br>
<br>

<table border="1" cellpadding="8">

    <thead>
      <tr>
        <th colspan="8" style="background-color: yellow;">RECENT UPDATE KUNJUNGAN GARDU </th>
      </tr>
    <tr >
    <th class="text-center">No </th>
    <th>Tanggal Masuk</th>
    <th>Nama Gardu</th>
    <th>Nama Petugas</th>
    <th>Nip</th>
    <th>Pekerjaan</th>
    <th>Check In</th>
    <th>Check Out</th>
    </tr>
    </thead>
    <tbody>
      <?php $no = 0;

      foreach ($record as $r) :
        $tanggal1 = new DateTime($r->date_request);
        $tanggal2 = new DateTime();

        $perbedaan = $tanggal2->diff($tanggal1);


        $btn_time_in = ($r->time_in == NULL) ? ' ' : date_format(date_create('2021-10-10 ' . $r->time_in), 'H:i');
        $btn_time_out = ($r->time_out == NULL) ? '' : date_format(date_create('2021-10-10 ' . $r->time_out), 'H:i');
        $btn_timeOut = ($r->time_in == NULL  && $r->time_out == NULL) ? ' ' : $btn_time_out;

        $user = $this->db->select('username')->get_where('tbl_user', ['id_user' => $r->id_user])->row();

      ?>
      <tr>
        <td class="table-plus"><?php echo ++$no; ?></td>

        <td><?php echo $r->date_request; ?></td>
        <td><?php echo $r->nama_gardu; ?></td>
        <td><?php echo $r->username; ?></td>
        <td><?php echo $r->nip; ?></td>
        <td><?php echo $r->pekerjaan; ?></td>
        <td style="font-size: 10px;">
          <?php if($r->time_in == null && $perbedaan->d > 0):?>
            00:00:00
          <?php else:?>
            <?= $btn_time_in ?>
          <?php endif;?>

        </td>
        <td style="font-size: 10px;">
          <?php if($r->time_out == null && $perbedaan->d > 0):?>
            00:00:00
          <?php elseif ($r->time_out == NULL && $r->time_in == NULL) : ?>
             <?php elseif ($r->time_out == NULL && $r->time_in != NULL) : ?>
           <?php else : ?>
             <div class="d-flex justify-content-center align-items-center">
              <span>
                <img style="width:60px;height:60px" class="mr-3" src="<?= base_url("uploads/".$r->image );?>" alt="">
              </span>
              <span> <?= date_format(date_create('2021-10-10 ' . $r->time_out), 'H:i'); ?></span>
             </div>

           <?php endif; ?>
        </td>
      </tr>
      <?php
      endforeach;
      ?>
    </tbody>
  </table>
