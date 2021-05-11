<?php

namespace App\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Representative;

class CelebrityType extends AbstractType
{
	/**
	 * @param FormBuilderInterface $builder
	 * @param array                $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('name', TextType::class)
			->add('birthday', DateType::class, [
				'required' => true
			])
			->add('bio', TextType::class, [
				'required' => true
			])
			->add( 'representatives', EntityType::class, array(
					// query choices from this entity
					'class'        => 'App\Entity\Representative',
					'query_builder' => function (EntityRepository $er) {
				        return $er->createQueryBuilder('r')
				            ->orderBy('r.name', 'ASC');
				    },
					// set the field in the entity to use
					'choice_label' => 'name',
					'label' => 'name',
					'multiple' => true,
					'placeholder'  => ' - Select a Representative - ',
					'empty_data'   => null,
					'attr'  => array(
						'class' => 'select2'
					)
				) )
			->add('submit', SubmitType::class, [
				'attr' => ['class' => 'btn-primary'],
			]);
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
			'data_class' => 'App\Entity\Celebrity',
		]);
	}
}