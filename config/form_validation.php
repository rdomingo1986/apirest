<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = [
  'sign-in' => [
    [
      'field' => 'email',
      'label' => 'Email del usuario',
      'rules' => 'required|max_length[255]|valid_email'
    ],
    [
      'field' => 'password',
      'label' => 'Contraseña del usuario',
      'rules' => 'required|min_length[8]'
    ]
  ],
  'get-main-agency-list' => [
    [
      'field' => 'limit',
      'label' => 'limit',
      'rules' => 'required|is_natural_no_zero'
    ],
    [
      'field' => 'offset',
      'label' => 'offset',
      'rules' => 'required|is_natural'
    ],
    [
      'field' => 'keyword',
      'label' => 'keyword',
      'rules' => 'required|max_length[255]'
    ],
    [
      'field' => 'condition',
      'label' => 'condition',
      'rules' => 'required|in_list[null,propia,administrada]'
    ],
    [
      'field' => 'personType',
      'label' => 'personType',
      'rules' => 'required|in_list[null,natural,juridica]'
    ],
    [
      'field' => 'owner_id',
      'label' => 'owner_id',
      'rules' => 'required|is_natural_no_zero'
    ]
  ],
  'company-name-is-unique' => [
    [
      'field' => 'companyName',
      'label' => 'Razón Social',
      'rules' => 'required|max_length[150]'
    ]
  ],
  'rfc-is-unique' => [
    [
      'field' => 'RFC',
      'label' => 'rfc',
      'rules' => 'required|max_length[50]'
    ]
  ],
  'email-is-unique' => [
    [
      'field' => 'email',
      'label' => 'Correo Electrónico',
      'rules' => 'required|max_length[255]|valid_email'
    ]
  ],
  'create-main-agency-own-person' => [
    [
      'field' => 'owner_id',
      'label' => 'owner_id',
      'rules' => 'required|is_natural_no_zero'
    ],
    [
      'field' => 'first_name',
      'label' => 'first_name',
      'rules' => 'required|max_length[100]'
    ],
    [
      'field' => 'last_name',
      'label' => 'last_name',
      'rules' => 'required|max_length[100]'
    ],
    [
      'field' => 'gender',
      'label' => 'gender',
      'rules' => 'required|in_list[masculino,femenino]'
    ],
    [
      'field' => 'phone_number',
      'label' => 'phone_number',
      'rules' => 'max_length[30]'
    ],
    [
      'field' => 'mobile_number',
      'label' => 'mobile_number',
      'rules' => 'max_length[30]'
    ],
    [
      'field' => 'company_name',
      'label' => 'company_name',
      'rules' => 'max_length[150]'
    ],
    [
      'field' => 'country_id',
      'label' => 'country',
      'rules' => 'is_natural_no_zero'
    ],
    [
      'field' => 'state',
      'label' => 'state',
      'rules' => 'max_length[100]'
    ],
    [
      'field' => 'city',
      'label' => 'city',
      'rules' => 'max_length[100]'
    ],
    [
      'field' => 'address',
      'label' => 'address',
      'rules' => 'max_length[255]'
    ],
    [
      'field' => 'zip_code',
      'label' => 'zip_code',
      'rules' => 'max_length[50]'
    ]
  ],
  'create-main-agency-own-company' => [
    [
      'field' => 'owner_id',
      'label' => 'owner_id',
      'rules' => 'required|is_natural_no_zero'
    ],
    [
      'field' => 'first_name',
      'label' => 'first_name',
      'rules' => 'max_length[100]'
    ],
    [
      'field' => 'last_name',
      'label' => 'last_name',
      'rules' => 'max_length[100]'
    ],
    [
      'field' => 'gender',
      'label' => 'gender',
      'rules' => 'in_list[masculino,femenino]'
    ],
    [
      'field' => 'phone_number',
      'label' => 'phone_number',
      'rules' => 'max_length[30]'
    ],
    [
      'field' => 'mobile_number',
      'label' => 'mobile_number',
      'rules' => 'max_length[30]'
    ],
    [
      'field' => 'company_name',
      'label' => 'company_name',
      'rules' => 'required|max_length[150]'
    ],
    [
      'field' => 'rfc',
      'label' => 'rfc',
      'rules' => 'required|max_length[50]'
    ],
    [
      'field' => 'country_id',
      'label' => 'country',
      'rules' => 'required|is_natural_no_zero'
    ],
    [
      'field' => 'state',
      'label' => 'state',
      'rules' => 'required|max_length[100]'
    ],
    [
      'field' => 'city',
      'label' => 'city',
      'rules' => 'required|max_length[100]'
    ],
    [
      'field' => 'address',
      'label' => 'address',
      'rules' => 'required|max_length[255]'
    ],
    [
      'field' => 'zip_code',
      'label' => 'zip_code',
      'rules' => 'required|max_length[50]'
    ]
  ],
  'create-main-agency-administered-person' => [
    [
      'field' => 'owner_id',
      'label' => 'owner_id',
      'rules' => 'required|is_natural_no_zero'
    ],
    [
      'field' => 'email',
      'label' => 'email',
      'rules' => 'required|max_length[255]|valid_email'
    ],
    [
      'field' => 'first_name',
      'label' => 'first_name',
      'rules' => 'required|max_length[100]'
    ],
    [
      'field' => 'last_name',
      'label' => 'last_name',
      'rules' => 'required|max_length[100]'
    ],
    [
      'field' => 'gender',
      'label' => 'gender',
      'rules' => 'required|in_list[masculino,femenino]'
    ],
    [
      'field' => 'phone_number',
      'label' => 'phone_number',
      'rules' => 'max_length[30]'
    ],
    [
      'field' => 'mobile_number',
      'label' => 'mobile_number',
      'rules' => 'max_length[30]'
    ],
    [
      'field' => 'company_name',
      'label' => 'company_name',
      'rules' => 'max_length[150]'
    ],
    [
      'field' => 'country_id',
      'label' => 'country',
      'rules' => 'is_natural_no_zero'
    ],
    [
      'field' => 'state',
      'label' => 'state',
      'rules' => 'max_length[100]'
    ],
    [
      'field' => 'city',
      'label' => 'city',
      'rules' => 'max_length[100]'
    ],
    [
      'field' => 'address',
      'label' => 'address',
      'rules' => 'max_length[255]'
    ],
    [
      'field' => 'zip_code',
      'label' => 'zip_code',
      'rules' => 'max_length[50]'
    ]
  ],
  'create-main-agency-administered-company' => [
    [
      'field' => 'owner_id',
      'label' => 'owner_id',
      'rules' => 'required|is_natural_no_zero'
    ],
    [
      'field' => 'email',
      'label' => 'email',
      'rules' => 'required|max_length[255]|valid_email'
    ],
    [
      'field' => 'first_name',
      'label' => 'first_name',
      'rules' => 'max_length[100]'
    ],
    [
      'field' => 'last_name',
      'label' => 'last_name',
      'rules' => 'max_length[100]'
    ],
    [
      'field' => 'gender',
      'label' => 'gender',
      'rules' => 'in_list[masculino,femenino]'
    ],
    [
      'field' => 'phone_number',
      'label' => 'phone_number',
      'rules' => 'max_length[30]'
    ],
    [
      'field' => 'mobile_number',
      'label' => 'mobile_number',
      'rules' => 'max_length[30]'
    ],
    [
      'field' => 'company_name',
      'label' => 'company_name',
      'rules' => 'required|max_length[150]'
    ],
    [
      'field' => 'rfc',
      'label' => 'rfc',
      'rules' => 'required|max_length[50]'
    ],
    [
      'field' => 'country_id',
      'label' => 'country',
      'rules' => 'required|is_natural_no_zero'
    ],
    [
      'field' => 'state',
      'label' => 'state',
      'rules' => 'required|max_length[100]'
    ],
    [
      'field' => 'city',
      'label' => 'city',
      'rules' => 'required|max_length[100]'
    ],
    [
      'field' => 'address',
      'label' => 'address',
      'rules' => 'required|max_length[255]'
    ],
    [
      'field' => 'zip_code',
      'label' => 'zip_code',
      'rules' => 'required|max_length[50]'
    ]
  ],
  'get-agency-data-by-id' => [
    [
      'field' => 'id',
      'label' => 'id',
      'rules' => 'required|is_natural_no_zero'
    ]
  ],
  'get-clients-list-by-agency-id' => [
    [
      'field' => 'limit',
      'label' => 'limit',
      'rules' => 'required|is_natural_no_zero'
    ],
    [
      'field' => 'offset',
      'label' => 'offset',
      'rules' => 'required|is_natural'
    ],
    [
      'field' => 'keyword',
      'label' => 'keyword',
      'rules' => 'required|max_length[255]'
    ],
    [
      'field' => 'type',
      'label' => 'Tipo de cliente',
      'rules' => 'required|in_list[null,subagencia,cliente]'
    ],
    [
      'field' => 'status',
      'label' => 'personType',
      'rules' => 'required|in_list[null,activo,inactivo,poractualizar,porautorizar]'
    ],
    [
      'field' => 'parent_id',
      'label' => 'ID de la entidad padre',
      'rules' => 'required|is_natural_no_zero'
    ]
  ],
  'get-category-list-by-agency-id' => [
    [
      'field' => 'limit',
      'label' => 'limit',
      'rules' => 'required|is_natural_no_zero'
    ],
    [
      'field' => 'offset',
      'label' => 'offset',
      'rules' => 'required|is_natural'
    ],
    [
      'field' => 'keyword',
      'label' => 'keyword',
      'rules' => 'required|max_length[255]'
    ],
    [
      'field' => 'byFilter',
      'label' => 'filtrar por',
      'rules' => 'required|in_list[null,name,discount,commission]'
    ],
    [
      'field' => 'orderBy',
      'label' => 'ordernar de forma',
      'rules' => 'required|in_list[null,ascendente,descendente]'
    ],
    [
      'field' => 'agencyId',
      'label' => 'ID de la entidad padre',
      'rules' => 'required|is_natural_no_zero'
    ]
  ],
  'get-categories-combo-by-agency-id' => [
    [
      'field' => 'id',
      'label' => 'id',
      'rules' => 'required|is_natural_no_zero'
    ]
  ],
  'get-item-list-by-agency-id' => [
    [
      'field' => 'limit',
      'label' => 'limit',
      'rules' => 'required|is_natural_no_zero'
    ],
    [
      'field' => 'offset',
      'label' => 'offset',
      'rules' => 'required|is_natural'
    ],
    [
      'field' => 'keyword',
      'label' => 'keyword',
      'rules' => 'required|max_length[255]'
    ],
    [
      'field' => 'itemType',
      'label' => 'filtrar por',
      'rules' => 'required|in_list[null,producto,servicio]'
    ],
    [
      'field' => 'filterCategory',
      'label' => 'ordernar de forma',
      'rules' => 'required'
    ],
    [
      'field' => 'itemCondition',
      'label' => 'Condición del artículo',
      'rules' => 'required|in_list[null,propio,asignado]'
    ],
    [
      'field' => 'agencyId',
      'label' => 'ID de la entidad padre',
      'rules' => 'required|is_natural_no_zero'
    ]
  ],
  'edit-main-agency-own-person' => [
    [
      'field' => 'id',
      'label' => 'id',
      'rules' => 'required|is_natural_no_zero'
    ],
    [
      'field' => 'first_name',
      'label' => 'first_name',
      'rules' => 'required|max_length[100]'
    ],
    [
      'field' => 'last_name',
      'label' => 'last_name',
      'rules' => 'required|max_length[100]'
    ],
    [
      'field' => 'gender',
      'label' => 'gender',
      'rules' => 'required|in_list[masculino,femenino]'
    ],
    [
      'field' => 'phone_number',
      'label' => 'phone_number',
      'rules' => 'max_length[30]'
    ],
    [
      'field' => 'mobile_number',
      'label' => 'mobile_number',
      'rules' => 'max_length[30]'
    ],
    [
      'field' => 'company_name',
      'label' => 'company_name',
      'rules' => 'max_length[150]'
    ],
    [
      'field' => 'country_id',
      'label' => 'country',
      'rules' => 'is_natural_no_zero'
    ],
    [
      'field' => 'state',
      'label' => 'state',
      'rules' => 'max_length[100]'
    ],
    [
      'field' => 'city',
      'label' => 'city',
      'rules' => 'max_length[100]'
    ],
    [
      'field' => 'address',
      'label' => 'address',
      'rules' => 'max_length[255]'
    ],
    [
      'field' => 'zip_code',
      'label' => 'zip_code',
      'rules' => 'max_length[50]'
    ]
  ],
  'edit-main-agency-own-company' => [
    [
      'field' => 'id',
      'label' => 'id',
      'rules' => 'required|is_natural_no_zero'
    ],
    [
      'field' => 'first_name',
      'label' => 'first_name',
      'rules' => 'max_length[100]'
    ],
    [
      'field' => 'last_name',
      'label' => 'last_name',
      'rules' => 'max_length[100]'
    ],
    [
      'field' => 'gender',
      'label' => 'gender',
      'rules' => 'in_list[masculino,femenino]'
    ],
    [
      'field' => 'phone_number',
      'label' => 'phone_number',
      'rules' => 'max_length[30]'
    ],
    [
      'field' => 'mobile_number',
      'label' => 'mobile_number',
      'rules' => 'max_length[30]'
    ],
    [
      'field' => 'company_name',
      'label' => 'company_name',
      'rules' => 'required|max_length[150]'
    ],
    [
      'field' => 'rfc',
      'label' => 'rfc',
      'rules' => 'required|max_length[50]'
    ],
    [
      'field' => 'country_id',
      'label' => 'country',
      'rules' => 'required|is_natural_no_zero'
    ],
    [
      'field' => 'state',
      'label' => 'state',
      'rules' => 'required|max_length[100]'
    ],
    [
      'field' => 'city',
      'label' => 'city',
      'rules' => 'required|max_length[100]'
    ],
    [
      'field' => 'address',
      'label' => 'address',
      'rules' => 'required|max_length[255]'
    ],
    [
      'field' => 'zip_code',
      'label' => 'zip_code',
      'rules' => 'required|max_length[50]'
    ]
  ],
  'edit-main-agency-administered-person' => [
    [
      'field' => 'id',
      'label' => 'id',
      'rules' => 'required|is_natural_no_zero'
    ],
    [
      'field' => 'email',
      'label' => 'email',
      'rules' => 'required|max_length[255]|valid_email'
    ],
    [
      'field' => 'first_name',
      'label' => 'first_name',
      'rules' => 'required|max_length[100]'
    ],
    [
      'field' => 'last_name',
      'label' => 'last_name',
      'rules' => 'required|max_length[100]'
    ],
    [
      'field' => 'gender',
      'label' => 'gender',
      'rules' => 'required|in_list[masculino,femenino]'
    ],
    [
      'field' => 'phone_number',
      'label' => 'phone_number',
      'rules' => 'max_length[30]'
    ],
    [
      'field' => 'mobile_number',
      'label' => 'mobile_number',
      'rules' => 'max_length[30]'
    ],
    [
      'field' => 'company_name',
      'label' => 'company_name',
      'rules' => 'max_length[150]'
    ],
    [
      'field' => 'country_id',
      'label' => 'country',
      'rules' => 'is_natural_no_zero'
    ],
    [
      'field' => 'state',
      'label' => 'state',
      'rules' => 'max_length[100]'
    ],
    [
      'field' => 'city',
      'label' => 'city',
      'rules' => 'max_length[100]'
    ],
    [
      'field' => 'address',
      'label' => 'address',
      'rules' => 'max_length[255]'
    ],
    [
      'field' => 'zip_code',
      'label' => 'zip_code',
      'rules' => 'max_length[50]'
    ]
  ],
  'edit-main-agency-administered-company' => [
    [
      'field' => 'id',
      'label' => 'id',
      'rules' => 'required|is_natural_no_zero'
    ],
    [
      'field' => 'email',
      'label' => 'email',
      'rules' => 'required|max_length[255]|valid_email'
    ],
    [
      'field' => 'first_name',
      'label' => 'first_name',
      'rules' => 'max_length[100]'
    ],
    [
      'field' => 'last_name',
      'label' => 'last_name',
      'rules' => 'max_length[100]'
    ],
    [
      'field' => 'gender',
      'label' => 'gender',
      'rules' => 'in_list[masculino,femenino]'
    ],
    [
      'field' => 'phone_number',
      'label' => 'phone_number',
      'rules' => 'max_length[30]'
    ],
    [
      'field' => 'mobile_number',
      'label' => 'mobile_number',
      'rules' => 'max_length[30]'
    ],
    [
      'field' => 'company_name',
      'label' => 'company_name',
      'rules' => 'required|max_length[150]'
    ],
    [
      'field' => 'rfc',
      'label' => 'rfc',
      'rules' => 'required|max_length[50]'
    ],
    [
      'field' => 'country_id',
      'label' => 'country',
      'rules' => 'required|is_natural_no_zero'
    ],
    [
      'field' => 'state',
      'label' => 'state',
      'rules' => 'required|max_length[100]'
    ],
    [
      'field' => 'city',
      'label' => 'city',
      'rules' => 'required|max_length[100]'
    ],
    [
      'field' => 'address',
      'label' => 'address',
      'rules' => 'required|max_length[255]'
    ],
    [
      'field' => 'zip_code',
      'label' => 'zip_code',
      'rules' => 'required|max_length[50]'
    ]
  ],
  'register-entity-person' => [
    [
      'field' => 'parent_id',
      'label' => 'parent_id',
      'rules' => 'required|is_natural_no_zero'
    ],
    [
      'field' => 'role',
      'label' => 'role',
      'rules' => 'required|in_list[subagencia,cliente]'
    ],
    [
      'field' => 'email',
      'label' => 'email',
      'rules' => 'required|max_length[255]|valid_email'
    ],
    [
      'field' => 'first_name',
      'label' => 'first_name',
      'rules' => 'required|max_length[100]'
    ],
    [
      'field' => 'last_name',
      'label' => 'last_name',
      'rules' => 'required|max_length[100]'
    ],
    [
      'field' => 'gender',
      'label' => 'gender',
      'rules' => 'required|in_list[masculino,femenino]'
    ],
    [
      'field' => 'phone_number',
      'label' => 'phone_number',
      'rules' => 'max_length[30]'
    ],
    [
      'field' => 'mobile_number',
      'label' => 'mobile_number',
      'rules' => 'max_length[30]'
    ],
    [
      'field' => 'rfc',
      'label' => 'rfc',
      'rules' => 'max_length[50]'
    ],
    [
      'field' => 'company_name',
      'label' => 'company_name',
      'rules' => 'max_length[150]'
    ],
    [
      'field' => 'country_id',
      'label' => 'country',
      'rules' => 'is_natural_no_zero'
    ],
    [
      'field' => 'state',
      'label' => 'state',
      'rules' => 'max_length[100]'
    ],
    [
      'field' => 'city',
      'label' => 'city',
      'rules' => 'max_length[100]'
    ],
    [
      'field' => 'address',
      'label' => 'address',
      'rules' => 'max_length[255]'
    ],
    [
      'field' => 'zip_code',
      'label' => 'zip_code',
      'rules' => 'max_length[50]'
    ]
  ],
  'register-entity-company' => [
    [
      'field' => 'parent_id',
      'label' => 'parent_id',
      'rules' => 'required|is_natural_no_zero'
    ],
    [
      'field' => 'role',
      'label' => 'role',
      'rules' => 'required|in_list[subagencia,cliente]'
    ],
    [
      'field' => 'email',
      'label' => 'email',
      'rules' => 'required|max_length[255]|valid_email'
    ],
    [
      'field' => 'first_name',
      'label' => 'first_name',
      'rules' => 'max_length[100]'
    ],
    [
      'field' => 'last_name',
      'label' => 'last_name',
      'rules' => 'max_length[100]'
    ],
    [
      'field' => 'gender',
      'label' => 'gender',
      'rules' => 'in_list[masculino,femenino]'
    ],
    [
      'field' => 'phone_number',
      'label' => 'phone_number',
      'rules' => 'max_length[30]'
    ],
    [
      'field' => 'mobile_number',
      'label' => 'mobile_number',
      'rules' => 'max_length[30]'
    ],
    [
      'field' => 'company_name',
      'label' => 'company_name',
      'rules' => 'required|max_length[150]'
    ],
    [
      'field' => 'rfc',
      'label' => 'rfc',
      'rules' => 'required|max_length[50]'
    ],
    [
      'field' => 'country_id',
      'label' => 'country',
      'rules' => 'required|is_natural_no_zero'
    ],
    [
      'field' => 'state',
      'label' => 'state',
      'rules' => 'required|max_length[100]'
    ],
    [
      'field' => 'city',
      'label' => 'city',
      'rules' => 'required|max_length[100]'
    ],
    [
      'field' => 'address',
      'label' => 'address',
      'rules' => 'required|max_length[255]'
    ],
    [
      'field' => 'zip_code',
      'label' => 'zip_code',
      'rules' => 'required|max_length[50]'
    ]
  ],
  'create-new-category' => [
    [
      'field' => 'agencyId',
      'label' => 'Id del usuario dueño de la categoria',
      'rules' => 'required|numeric'
    ],
    [
      'field' => 'name',
      'label' => 'Nombre de la categoria',
      'rules' => 'required|max_length[80]'
    ],
    [
      'field' => 'description',
      'label' => 'Descripción de la categoria',
      'rules' => 'max_length[255]'
    ],
    [
      'field' => 'discount',
      'label' => 'Porcentaje de descuento',
      'rules' => 'required|decimal'
    ],
    [
      'field' => 'commission',
      'label' => 'Porcentaje de comisión',
      'rules' => 'required|decimal'
    ]
  ],
  'create-new-item' => [
    [
      'field' => 'agencyId',
      'label' => 'Id del usuario dueño del producto',
      'rules' => 'required|numeric'
    ],
    [
      'field' => 'categoryId',
      'label' => 'Id de la categoria del producto',
      'rules' => 'numeric'
    ],
    [
      'field' => 'name',
      'label' => 'Nombre del producto',
      'rules' => 'required|max_length[80]'
    ],
    [
      'field' => 'description',
      'label' => 'Descripción del producto',
      'rules' => 'required'
    ],
    [
      'field' => 'priceInCash',
      'label' => 'Precio de contado del item',
      'rules' => 'required|decimal'
    ],
    [
      'field' => 'percentAumCredit',
      'label' => 'Porcentaje de aumento en la cuota cuando es a crédito',
      'rules' => 'required|decimal'
    ],
    [
      'field' => 'itemType',
      'label' => 'Tipo de item',
      'rules' => 'required|in_list[producto,servicio]'
    ],
    [
      'field' => 'discount',
      'label' => 'Porcentaje de descuento',
      'rules' => 'required|decimal'
    ],
    [
      'field' => 'commission',
      'label' => 'Porcentaje de comisión',
      'rules' => 'required|decimal'
    ],
    [
      'field' => 'agenciesList[]',
      'label' => 'Porcentaje de comisión',
      'rules' => 'numeric'
    ]
  ],

  'autoregister-entity' => [
    [
      'field' => 'names',
      'label' => 'Nombres de la persona',
      'rules' => 'required|max_length[100]'
    ],
    [
      'field' => 'lastNames',
      'label' => 'Apellidos de la persona',
      'rules' => 'required|max_length[100]'
    ],
    [
      'field' => 'email',
      'label' => 'Correo Electrónico',
      'rules' => 'required|max_length[255]|valid_email'
    ],
    [
      'field' => 'password',
      'label' => 'Contraseña del usuario',
      'rules' => 'required|min_length[8]'
    ],
    [
      'field' => 'passwordRepeat',
      'label' => 'Repetir Contraseña del usuario',
      'rules' => 'required|matches[password]'
    ],
    [
      'field' => 'gender',
      'label' => 'Genero de la persona',
      'rules' => 'required|in_list[masculino,femenino]'
    ],
    [
      'field' => 'legalTerms',
      'label' => 'Términos legales de la cuenta',
      'rules' => 'required|in_list[on]'
    ],
    [
      'field' => 'role',
      'label' => 'Tipo de usuario',
      'rules' => 'required|in_list[agencia,cliente]'
    ],
    [
      'field' => 'accountStatus',
      'label' => 'Estatus de la cuenta',
      'rules' => 'required|in_list[autoregistro,normal,porcambiarclave,poractualizar]'
    ],
    [
      'field' => 'parentAgencyCode',
      'label' => 'Código de la agencia',
      'rules' => 'required'
    ]   
  ],
  // 'ajax-validate-email' => [
  //   [
  //     'field' => 'email',
  //     'label' => 'Correo Electrónico',
  //     'rules' => 'required|max_length[255]|valid_email'
  //   ],
  //   [
  //     'field' => 'module',
  //     'label' => 'Modulo para la consulta',
  //     'rules' => 'required|in_list[registerclient,forgotpassword]'
  //   ]
  // ],
  'ajax-validate-old-password' => [
    [
      'field' => 'oldPassword',
      'label' => 'contraseña anterior',
      'rules' => 'required|min_length[8]'
    ]
  ],
  
  'forgot-password' => [
    [
      'field' => 'email',
      'label' => 'Email del usuario',
      'rules' => 'required|max_length[255]|valid_email'
    ]
  ],
  'recovery-password' => [
    [
      'field' => 'password',
      'label' => 'Contraseña',
      'rules' => 'required|min_length[8]'
    ],
    [
      'field' => 'passwordRepeat',
      'label' => 'Repetir Contraseña',
      'rules' => 'required|matches[password]'
    ],
    [
      'field' => 'resetPasswordCode',
      'label' => 'Codigo de reinicio de contraseña',
      'rules' => 'required'
    ]
  ],
  'reset-password' => [
    [
      'field' => 'oldPassword',
      'label' => 'Contraseña anterior',
      'rules' => 'required|min_length[8]'
    ],
    [
      'field' => 'newPassword',
      'label' => 'Contraseña',
      'rules' => 'required|min_length[8]'
    ],
    [
      'field' => 'newPasswordRepeat',
      'label' => 'Repetir Contraseña',
      'rules' => 'required|matches[newPassword]'
    ]
  ],
  'reset-password-entity' => [
    [
      'field' => 'clientId',
      'label' => 'ID de la entidad',
      'rules' => 'required|numeric'
    ],
    [
      'field' => 'password',
      'label' => 'Contraseña',
      'rules' => 'required|min_length[8]'
    ]
  ],
  'activate-inactivate-entity' => [
    [
      'field' => 'clientId',
      'label' => 'ID de la entidad',
      'rules' => 'required|numeric'
    ]
  ],
  'approve-entity-membership' => [
    [
      'field' => 'clientId',
      'label' => 'ID de la entidad',
      'rules' => 'required|numeric'
    ]
  ],
  'upgrade-entity-membership' => [
    [
      'field' => 'clientId',
      'label' => 'ID de la entidad',
      'rules' => 'required|numeric'
    ]
  ],
  'request-account-upgrade' => [
    [
      'field' => 'clientId',
      'label' => 'ID de la entidad',
      'rules' => 'required|numeric'
    ],
    [
      'field' => 'userId',
      'label' => 'id del usuario',
      'rules' => 'required|numeric'
    ]
  ],
  'approve-upgrade-entity-membership' => [
    [
      'field' => 'clientId',
      'label' => 'ID de la entidad',
      'rules' => 'required|numeric'
    ]
  ],
  'desappprove-upgrade-entity-membership' => [
    [
      'field' => 'clientId',
      'label' => 'ID de la entidad',
      'rules' => 'required|numeric'
    ]
  ],
  
  
  
];