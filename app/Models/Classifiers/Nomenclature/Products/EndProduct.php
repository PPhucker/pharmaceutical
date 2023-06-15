<?php

namespace App\Models\Classifiers\Nomenclature\Products;

use App\Models\Auth\User;
use App\Models\Classifiers\Nomenclature\OKEI;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Classifiers\Nomenclature\Products\EndProduct
 *
 * @property int $id
 * @property int|null $userId
 * @property int|null $typeId Тип готовой продукции
 * @property int|null $internationalNameId Межд. непатент. название
 * @property int|null                                                           $registrationNumberId Регистрационный номер
 * @property string|null                                                        $okeiCode Код ОКЕИ
 * @property string|null                                                        $okpd2Code Код ОКПД2
 * @property string                                                             $shortName Краткое название
 * @property string                                                             $fullName Полное наименование
 * @property int                                                                $marking Маркировка (1-да/0-нет)
 * @property int                                                                $bestBeforeDate Срок годности (в месяцах)
 * @property Carbon|null                                                        $createdAt
 * @property Carbon|null                                                        $updatedAt
 * @property Carbon|null                                                        $deletedAt
 * @property-read Collection<int, ProductCatalog> $catalogProducts
 * @property-read int|null                                                      $catalogProductsCount
 * @property-read InternationalNameOfEndProduct|null                            $internationalName
 * @property-read OKEI|null                                                     $okei
 * @property-read OKPD2|null                                                    $okpd2
 * @property-read RegistrationNumberOfEndProduct|null                           $registrationNumber
 * @property-read TypeOfEndProduct|null                                         $type
 * @property-read User|null                                                     $user
 * @method static Builder|EndProduct newModelQuery()
 * @method static Builder|EndProduct newQuery()
 * @method static Builder|EndProduct onlyTrashed()
 * @method static Builder|EndProduct query()
 * @method static Builder|EndProduct whereBestBeforeDate($value)
 * @method static Builder|EndProduct whereCreatedAt($value)
 * @method static Builder|EndProduct whereDeletedAt($value)
 * @method static Builder|EndProduct whereFullName($value)
 * @method static Builder|EndProduct whereId($value)
 * @method static Builder|EndProduct whereInternationalNameId($value)
 * @method static Builder|EndProduct whereMarking($value)
 * @method static Builder|EndProduct whereOkeiCode($value)
 * @method static Builder|EndProduct whereOkpd2Code($value)
 * @method static Builder|EndProduct whereRegistrationNumberId($value)
 * @method static Builder|EndProduct whereShortName($value)
 * @method static Builder|EndProduct whereTypeId($value)
 * @method static Builder|EndProduct whereUpdatedAt($value)
 * @method static Builder|EndProduct whereUserId($value)
 * @method static Builder|EndProduct withTrashed()
 * @method static Builder|EndProduct withoutTrashed()
 * @property-read Collection<int, \App\Models\Classifiers\Nomenclature\Products\ProductCatalog> $catalogProducts
 * @mixin Eloquent
 */
class EndProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'classifier_end_products';

    protected $fillable = [
        'user_id',
        'type_id',
        'international_name_id',
        'registration_number_id',
        'okei_code',
        'okpd2_code',
        'short_name',
        'full_name',
        'marking',
        'best_before_date',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::parse($date)
            ->format('d.m.Y H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')
            ->withTrashed();
    }

    public function type()
    {
        return $this->belongsTo(TypeOfEndProduct::class, 'type_id');
    }

    public function internationalName()
    {
        return $this->belongsTo(InternationalNameOfEndProduct::class, 'international_name_id');
    }

    public function registrationNumber()
    {
        return $this->belongsTo(RegistrationNumberOfEndProduct::class, 'registration_number_id');
    }

    public function okei()
    {
        return $this->belongsTo(OKEI::class, 'okei_code');
    }

    public function okpd2()
    {
        return $this->belongsTo(OKPD2::class, 'okpd2_code');
    }

    public function catalogProducts()
    {
        return $this->hasMany(ProductCatalog::class, 'product_id');
    }
}
