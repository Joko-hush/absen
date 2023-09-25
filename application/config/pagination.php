<?php

// pagination
        $config['base_url'] = 'https://waosdentallaboratory.com/spk/team/dokter';
      
        $config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';
        $config['full_tag_closed'] = ' </ul></nav>">';
        
        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_closed'] = '</li>';
        
        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_closed'] = '</li>';
        
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_closed'] = '</li>';
        
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_closed'] = '</li>';
        
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_closed'] = '</a></li>';
        
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_closed'] = '</li>';
        
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_closed'] = '</li>';
        
        $config['attributes'] = array('class' => 'page-link');