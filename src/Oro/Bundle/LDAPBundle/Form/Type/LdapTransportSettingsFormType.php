<?php
/**
 * LdapTransportSettingsFormType.php
 *
 * Project: crm-enterprise-dev
 * Author: Jakub Babiak <jakub@babiak.cz>
 * Created: 13/05/15 13:59
 */

namespace Oro\Bundle\LDAPBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LdapTransportSettingsFormType  extends AbstractType
{
    const NAME = 'oro_ldap_ldap_transport_setting_form_type';

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'server_hostname',
            'url',
            [
                'label' => 'oro.ldap.transport.ldap.fields.server_hostname.label',
                'required' => true,
            ]
        );
        $builder->add(
            'server_port',
            'integer',
            [
                'label' => 'oro.ldap.transport.ldap.fields.server_port.label',
                'required' => true,
            ]
        );
        $builder->add(
            'server_encryption',
            'oro_ldap_encryption',
            [
                'label' => 'oro.ldap.transport.ldap.fields.server_encryption.label',
                'required' => true,
            ]
        );
        $builder->add(
            'server_base_dn',
            'text',
            [
                'label' => 'oro.ldap.transport.ldap.fields.server_base_dn.label',
                'required' => true,
            ]
        );
        $builder->add(
            'admin_dn',
            'text',
            [
                'label' => 'oro.ldap.transport.ldap.fields.admin_dn.label',
                'required' => false,
            ]
        );
        $builder->add(
            'admin_password',
            'password',
            [
                'label' => 'oro.ldap.transport.ldap.fields.admin_password.label',
                'required' => false,
                'always_empty' => false,
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => "Oro\Bundle\LDAPBundle\Entity\LdapTransport"
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::NAME;
    }
}