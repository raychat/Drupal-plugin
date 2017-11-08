<?php
namespace Drupal\raychat\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

class FormShow extends ConfigFormBase {

    public function createTable(){
        $storage = \Drupal::entityTypeManager()->getStorage('data_table_config');
        $table = $storage->load('raychat_table');
        if(!$table){
            $table = $storage->create(array(
                'id' => 'raychat_table',
                'description' => 'raychat table module',
                'table_schema' => array(
                  array(
                    'name' => 'id',
                    'type' => 'serial',
                    'primary' => TRUE,
                  ),
                  array(
                    'name' => 'token',
                    'type' => 'varchar',
                    'length' => 32,
                  )
                ),
            ));
            $table->save();
        }
    }

    /**
     * Returns a unique string identifying the form.
     *
     * @return string
     *   The unique string identifying the form.
     */
    public function getFormId() {
        return 'form_uuid';
    }

    /**
     * Form constructor.
     *
     * @param array                                $form
     *   An associative array containing the structure of the form.
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     *   The current state of the form.
     *
     * @return array
     *   The form structure.
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
//        \Drupal::state()->delete('raychat');
        $val = \Drupal::state()->get('raychat');


//        $form['image1'] = array(
//            '#markup' => theme('image', array('path' => 'img/raychat.png', 'attributes' => array())),
//            '#name' => 'image1',
//            '#id' => 'image1',
//        );

        if(empty($val)){
            $form['description'] = [
                '#type' => 'html_tag',
                '#tag' => 'strong',
                '#value' => 'تبریک میگوییم، شما برای نصب ابزارک رایچت در سایتتان نصف راه را پیموده اید :)'
            ];

            $form['sub_description'] = [
                '#type' => 'html_tag',
                '#tag' => 'p',
                '#value' => 'اکنون از پنل
                <a href="http://raychat.io/admin" target="_blank">مدیریت رایچت</a>

                از قسمت تنظیمات کانال
                توکن کانال مورد نظر را در کادر زیر وارد کنید.'
            ];
        }else{
            $form['description'] = [
                '#type' => 'html_tag',
                '#tag' => 'p',
                '#value' => '<div class="success">
			تبریک میگوییم ابزارک رایچت در سایت شما با موفقیت نصب شد. برای فعال سازی ابزارک فقط کافیست یک بار دیگر سایت خود را بارگذاری کنید.        </div>'
            ];

            $form['login'] = [
                '#type' => 'html_tag',
                '#tag' => 'strong',
                '#value' => '1. ورود به پنل اپراتوری'
            ];
            $form['hr2'] = [
                '#type' => 'html_tag',
                '#tag' => 'p',
            ];
            $form['link_login'] = [
                '#type' => 'link',
                '#title' => 'ورود به ناحیه کاربری',
                '#url' => Url::fromUri('https://app.raychat.io')
            ];

            $form['hr2s'] = [
                '#type' => 'html_tag',
                '#tag' => 'p',
            ];
            $form['description_2'] = [
                '#type' => 'html_tag',
                '#tag' => 'strong',
                '#value' => '2. شخصی سازی ابزارک یا مدیریت اپراتور ها از طریق پنل مدیریت'
            ];
            $form['description_21'] = [
                '#type' => 'html_tag',
                '#tag' => 'p',
                '#value' => 'بعد از نصب و فعال سازی ابزارک برای هر چه بهتر مدیریت کردن اپراتور ها و شخصی سازی ابزارک میتوانید از طریق پنل مدیریت اقدام کنید'
            ];
            $form['hr222'] = [
                '#type' => 'html_tag',
                '#tag' => 'p',
            ];
            $form['link_login1'] = [
                '#type' => 'link',
                '#title' => 'ورود به پنل مدیریت',
                '#url' => Url::fromUri('https://raychat.io/login')
            ];
            $form['margin_1'] = [
                '#type' => 'html_tag',
                '#tag' => 'p',
                '#value' => '&nbsp;'
            ];
            $form['hr1'] = [
                '#type' => 'html_tag',
                '#tag' => 'hr',
            ];
        }


        $form['token'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Token ID'),
            '#default_value' => $val
        );
        $form['actions']['#type'] = 'actions';
        $form['actions']['submit'] = array(
            '#type' => 'submit',
            '#value' => $this->t('Save'),
            '#button_type' => 'primary',
        );
        if(!empty($val)){
            $form['actions']['submit']['#value'] = $this->t('Update');
        }else{

            $form['actions']['margin_1'] = [
                '#type' => 'html_tag',
                '#tag' => 'p',
                '#value' => '&nbsp;'
            ];
            $form['actions']['hr1'] = [
                '#type' => 'html_tag',
                '#tag' => 'hr',
            ];
            $form['actions']['description_2'] = [
                '#type' => 'html_tag',
                '#tag' => 'p',
                '#value' => 'چنانچه تا کنون در رایچت عضو نشده اید میتوانید از طریق لینک زیر در رایچت عضو شوید و به صورت نامحدود با کاربران وبسایتتون مکالمه کنید و فروش خود را چند برابر کنید '
            ];
            $form['actions']['link_signup'] = [
                '#title' => $this->t('عضویت'),
                '#type' => 'link',
                '#url' => Url::fromUri('https://raychat.io/signup')
            ];
            $form['actions']['margin_2'] = [
                '#type' => 'html_tag',
                '#tag' => 'p',
                '#value' => '&nbsp;'
            ];
            $form['actions']['hr2'] = [
                '#type' => 'html_tag',
                '#tag' => 'hr',
            ];
            $form['actions']['demo_link'] = [
                '#type' => 'html_tag',
                '#tag' => 'p',
                '#value' => '<p style="font-size: 12px">
                        رایچت، ابزار گفتگوی آنلاین |
                        <a href="http://raychat.io/" target="_blank">دمو</a>
                    </p>'
            ];
        }

        return $form;
    }

    /**
     * Form submission handler.
     *
     * @param array                                $form
     *   An associative array containing the structure of the form.
     * @param \Drupal\Core\Form\FormStateInterface $form_state
     *   The current state of the form.
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
//        drupal_set_message($this->t('Your phone number is @number', array('@number' => $form_state->getValue('token'))));
        \Drupal::state()->set('raychat', $form_state->getValue('token'));
        return parent::submitForm($form, $form_state);
    }

    public function validateForm(array &$form, FormStateInterface $form_state) {
        if(!preg_match("/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/", $form_state->getValue('token'))){
            $form_state->setErrorByName('token', 'توکن نامعتبر است.');
        }
        parent::validateForm($form, $form_state); // TODO: Change the autogenerated stub
    }

    /**
     * Gets the configuration names that will be editable.
     *
     * @return array
     *   An array of configuration object names that are editable if called in
     *   conjunction with the trait's config() method.
     */
    protected function getEditableConfigNames() {
        // TODO: Implement getEditableConfigNames() method.
    }
}