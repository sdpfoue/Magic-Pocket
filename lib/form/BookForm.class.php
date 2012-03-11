<?php

/**
 * Book form.
 *
 * @package    apus
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class BookForm extends BaseBookForm
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at'],$this['viewed'],
      $this['issold'],$this['ip'],$this['ip_address'],
      $this['recent_book_list'],$this['book_report_list'],
      $this['user_id'],$this['lastprompt'],$this['university'],
      $this['comment_number'],$this['new_comment_number'],
      $this['reply_number']);
      
    
    $this->widgetSchema['cover'] = new sfWidgetFormInputFileEditable(array(
      'label'     => '封面',
      'file_src'  => '../../../../uploads/cover/'.$this->getObject()->getCover(),
      'is_image'  => false,
      'edit_mode' => !$this->isNew(),
      'template'  => '<div><img src="%file%" style="max-width:220px;max-height:220px;"/><br />%delete% 删除此图片<br />%input%</div>',
    ));
    
     $this->validatorSchema['cover_delete'] = new sfValidatorPass();
     
     $this->validatorSchema['cover'] = new sfValidatorFile(array(
      'required'   => false,
      'path'       => sfConfig::get('sf_upload_dir').'/cover',
      'mime_types' => 'web_images',
      'max_size'=>524288,
    ));          
    
    $this->widgetSchema->setLabels(array('isbn'=>'ISBN','title'=>'书名 *',
      'edition'=>'版本','price'=>'价格 *','author'=>'作者','university'=>'大学',
      'address'=>'详细地址','description'=>'其它说明','link'=>'参考链接',
      'city_id'=>'选择城市','cover'=>'封面','publisher'=>'出版商',
      'publish_date'=>'出版时间'));
    $this->validatorSchema['link']=new sfValidatorUrl(array('required'=>false));
  }
}
