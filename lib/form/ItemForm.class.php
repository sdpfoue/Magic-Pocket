<?php

/**
 * Item form.
 *
 * @package    apus
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class ItemForm extends BaseItemForm
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at'],$this['lastsignin'],
      $this['recent_item_list'],$this['ip'],$this['ip_address']
      ,$this['viewed'],$this['user_id'],$this['issold'],$this['lastprompt'],
      $this['item_report_list'],$this['comment_number'],$this['reply_number'],
      $this['new_comment_number']);
    
    $this->widgetSchema['category_id']=new sfWidgetFormPropelChoice(array('model' => 'Category', 'add_empty' => '请选择'));
      
    $this->widgetSchema->setLabels(array('category_id'=>'选择分类 *','item_name'=>'物品名称 *',
      'item_detail'=>'物品描述 *','item_price'=>'价格 *','issold'=>'是否已出售',
      'address'=>'详细地址 ','link'=>'参考链接','city_id'=>'选择城市'));
   
    
    
    $this->widgetSchema['pic1'] = new sfWidgetFormInputFileEditable(array(
      'label'     => '图片1',
      'file_src'  => '../../../../uploads/item/'.$this->getObject()->getPic1(),
      'is_image'  => false,
      'edit_mode' => !$this->isNew(),
      'template'  => '<div><img src="%file%" style="max-width:220px;max-height:220px;" /><br />%delete% 删除此图片<br />%input%</div>',
    ));
    $this->widgetSchema['pic2'] = new sfWidgetFormInputFileEditable(array(
      'label'     => '图片2',
      'file_src'  => '../../../../uploads/item/'.$this->getObject()->getPic2(),
      'is_image'  => false,
      'edit_mode' => !$this->isNew(),
      'template'  => '<div><img src="%file%" style="max-width:220px;max-height:220px;"/><br />%delete% 删除此图片<br />%input%</div>',
    ));
    $this->widgetSchema['pic3'] = new sfWidgetFormInputFileEditable(array(
      'label'     => '图片3',
      'file_src'  => '../../../../uploads/item/'.$this->getObject()->getPic3(),
      'is_image'  => false,
      'edit_mode' => !$this->isNew(),
      'template'  => '<div><img src="%file%" style="max-width:220px;max-height:220px;"/><br />%delete% 删除此图片<br />%input%</div>',
    ));
    $this->widgetSchema['pic4'] = new sfWidgetFormInputFileEditable(array(
      'label'     => '图片4',
      'file_src'  => '../../../../uploads/item/'.$this->getObject()->getPic4(),
      'is_image'  => false,
      'edit_mode' => !$this->isNew(),
      'template'  => '<div><img src="%file%" style="max-width:220px;max-height:220px;"/><br />%delete% 删除此图片<br />%input%</div>',
    ));
 
    $this->validatorSchema['pic1_delete'] = new sfValidatorPass();
    $this->validatorSchema['pic2_delete'] = new sfValidatorPass();
    $this->validatorSchema['pic3_delete'] = new sfValidatorPass();
    $this->validatorSchema['pic4_delete'] = new sfValidatorPass();
    
    
    $this->validatorSchema['pic1'] = new sfValidatorFile(array(
      'required'   => false,
      'path'       => sfConfig::get('sf_upload_dir').'/item',
      'mime_types' => 'web_images',
      'max_size'=>524288,
    ));
    $this->validatorSchema['pic2'] = new sfValidatorFile(array(
      'required'   => false,
      'path'       => sfConfig::get('sf_upload_dir').'/item',
      'mime_types' => 'web_images',
      'max_size'=>524288,
    ));
    $this->validatorSchema['pic3'] = new sfValidatorFile(array(
      'required'   => false,
      'path'       => sfConfig::get('sf_upload_dir').'/item',
      'mime_types' => 'web_images',
    ));
    $this->validatorSchema['pic4'] = new sfValidatorFile(array(
      'required'   => false,
      'path'       => sfConfig::get('sf_upload_dir').'/item',
      'mime_types' => 'web_images',
      'max_size'=>524288,
    ));    
    
    $this->widgetSchema->setNameFormat('item[%s]');
    
    $this->validatorSchema['link']=new sfValidatorUrl(array('required'=>false));   
    //$this->widgetSchema->setHelp('city_id', '你可以到个人中心设置默认地址');    
  }
}
