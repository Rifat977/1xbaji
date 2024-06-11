<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('betting_model');
        $this->load->model('corn_model');
        $this->ci = &get_instance();
        $this->load->helper('betting');
        $this->load->helper("form");
    }

    // public function withdraw($user_id)
    // {
    //     //tblmeasure_withdraw
    //     $settle_amount = 0;
    //     $divition = 1;
    //     $get = $this->db->order_by('id',"desc")->limit(1)->get_where("tblmeasure_withdraw", ['user_id' => $user_id])->row();
    //     if (!empty($get)) {
    //         $settle_amount = $get->settle_amount;
    //     }
    //     foreach ($this->db->get_where('tblgames', ['user_id' => $user_id])->result() as  $game) {
    //         $get = $this->db->get_where('tblmeasure_withdraw', ['game_id' => $game->id, 'user_id' => $user_id])->row();
    //         if (!empty($get)) {
    //         } else {
    //             $amount = 0;
    //             if ($game->action == 'bet') {
    //                 $amount = $game->BetAmount;
    //                 if (floatval($game->after_amount) >= $settle_amount) {
    //                     // $settle_amount = 
    //                 } else {
    //                     $settle_amount =  $game->after_amount;
    //                 }
    //             } else if ($game->action == 'settle') {
    //                 $amount = $game->TransactionAmount;
    //                 if (floatval($game->after_amount) >= $settle_amount) {
    //                     $settle_amount += $game->TransactionAmount;
    //                 } else {
    //                     $settle_amount =  $game->after_amount;
    //                 }
    //             }

    //             $this->db->insert('tblmeasure_withdraw', [
    //                 'action' => $game->action,
    //                 'user_id' => $user_id,
    //                 'game_id' => $game->id,
    //                 'amount' => $amount,
    //                 'before_balance' => $game->before_amount,
    //                 'after_balance' => $game->after_amount,
    //                 'settle_amount' => $settle_amount
    //             ]);
    //         }
    //     }
    // }
}
