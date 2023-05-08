<?php

namespace Drupal\custom_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a custom block for SiteBlock.
 *
 * @Block (
 *   id = "custom_module",
 *   admin_label = @Translation("Site Block")
 * )
 */
class CustomBlock extends BlockBase
{

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        $message = $this->configuration['message'];
        return [
            '#markup' => '<span>' . $message . ' Thank you for visiting us.</span>',
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function blockAccess(AccountInterface $account)
    {
        return AccessResult::allowedIfHasPermission($account, 'access content');
    }

    /**
     * {@inheritdoc}
     */
    public function defaultConfiguration()
    {
        return [
            'message' => '',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function blockForm($form, FormStateInterface $form_state)
    {
        $config = $this->getConfiguration();
        $form['message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Message'),
            '#description' => $this->t('Enter the message to be displayed in the block.'),
            '#default_value' => $config['message'],
        ];
        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function blockSubmit($form, FormStateInterface $form_state)
    {
        $this->configuration['message'] = $form_state->getValue('message');
    }

}