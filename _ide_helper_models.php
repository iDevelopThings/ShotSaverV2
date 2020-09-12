<?php
/** @noinspection PhpUndefinedClassInspection */
/** @noinspection PhpFullyQualifiedNameUsageInspection */
/** @noinspection PhpUnusedAliasInspection */

namespace App
{

	use Illuminate\Contracts\Support\Arrayable;
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Eloquent\Relations\BelongsTo;
	use Illuminate\Database\Eloquent\Relations\HasMany;
	use Illuminate\Database\Eloquent\Relations\HasManyThrough;
	use Illuminate\Database\Eloquent\Relations\MorphToMany;
	use Illuminate\Database\Eloquent\Scope;
	use Illuminate\Notifications\DatabaseNotification;
	use Illuminate\Support\Carbon;
	use LaravelIdea\Helper\App\_FileCollection;
	use LaravelIdea\Helper\App\_FileFavouriteCollection;
	use LaravelIdea\Helper\App\_FileFavouriteQueryBuilder;
	use LaravelIdea\Helper\App\_FileQueryBuilder;
	use LaravelIdea\Helper\App\_FileViewCollection;
	use LaravelIdea\Helper\App\_FileViewQueryBuilder;
	use LaravelIdea\Helper\App\_UserCollection;
	use LaravelIdea\Helper\App\_UserQueryBuilder;
	use LaravelIdea\Helper\Illuminate\Notifications\_DatabaseNotificationCollection;
	use LaravelIdea\Helper\Illuminate\Notifications\_DatabaseNotificationQueryBuilder;

	/**
	 * @property int                                      $id
	 * @property int                                      $user_id
	 * @property string                                   $name
	 * @property string|null                              $description
	 * @property string|null                              $type
	 * @property string|null                              $mime_type
	 * @property string|null                              $extension
	 * @property string|null                              $hd
	 * @property string|null                              $sd
	 * @property string|null                              $thumb
	 * @property string|null                              $thumb_hd
	 * @property int|null                                 $size_in_bytes
	 * @property string|null                              $embed
	 * @property array|null                               $meta
	 * @property bool                                     $private
	 * @property string                                   $status
	 * @property Carbon|null                              $created_at
	 * @property Carbon|null                              $updated_at
	 * @property _FileFavouriteCollection|FileFavourite[] $favourites
	 * @method HasMany|_FileFavouriteQueryBuilder favourites()
	 * @property User                                     $user
	 * @method BelongsTo|_UserQueryBuilder user()
	 * @property _FileViewCollection|FileView[]           $views
	 * @method HasMany|_FileViewQueryBuilder views()
	 * @method _FileQueryBuilder newModelQuery()
	 * @method _FileQueryBuilder newQuery()
	 * @method static _FileQueryBuilder query()
	 * @method static _FileCollection|File[] all()
	 * @method static _FileQueryBuilder whereId($value)
	 * @method static _FileQueryBuilder whereUserId($value)
	 * @method static _FileQueryBuilder whereName($value)
	 * @method static _FileQueryBuilder whereDescription($value)
	 * @method static _FileQueryBuilder whereType($value)
	 * @method static _FileQueryBuilder whereMimeType($value)
	 * @method static _FileQueryBuilder whereExtension($value)
	 * @method static _FileQueryBuilder whereHd($value)
	 * @method static _FileQueryBuilder whereSd($value)
	 * @method static _FileQueryBuilder whereThumb($value)
	 * @method static _FileQueryBuilder whereThumbHd($value)
	 * @method static _FileQueryBuilder whereSizeInBytes($value)
	 * @method static _FileQueryBuilder whereEmbed($value)
	 * @method static _FileQueryBuilder whereMeta($value)
	 * @method static _FileQueryBuilder wherePrivate($value)
	 * @method static _FileQueryBuilder whereStatus($value)
	 * @method static _FileQueryBuilder whereCreatedAt($value)
	 * @method static _FileQueryBuilder whereUpdatedAt($value)
	 * @method static bool chunk(int $count, callable $callback)
	 * @method static bool chunkById(int $count, callable $callback, null|string $column = null, null|string $alias = null)
	 * @method static int count(string $columns = '*')
	 * @method static File create(array $attributes = [])
	 * @method static _FileQueryBuilder crossJoin(string $table, \Closure|null|string $first = null, null|string $operator = null, null|string
	 *         $second = null)
	 * @method static _FileCollection|File[] cursor()
	 * @method static int decrement(string $column, float|int $amount = 1, array $extra = [])
	 * @method static bool doesntExist()
	 * @method static _FileQueryBuilder each(callable $callback, int $count = 1000)
	 * @method static bool eachById(callable $callback, int $count = 1000, string $column = null, string $alias = null)
	 * @method static bool exists()
	 * @method static File|null find($id, array $columns = ['*'])
	 * @method static _FileCollection|File[] findMany(array|Arrayable $ids, array $columns = ['*'])
	 * @method static File findOrFail($id, array $columns = ['*'])
	 * @method static _FileCollection|File[] findOrNew($id, array $columns = ['*'])
	 * @method static File first(array $columns = ['*'])
	 * @method static File firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
	 * @method static File firstOrCreate(array $attributes, array $values = [])
	 * @method static File firstOrFail(array $columns = ['*'])
	 * @method static File firstOrNew(array $attributes, array $values = [])
	 * @method static File forceCreate(array $attributes)
	 * @method static _FileCollection|File[] fromQuery(string $query, array $bindings = [])
	 * @method static _FileCollection|File[] get(array $columns = ['*'])
	 * @method static int getCountForPagination(array $columns = ['*'])
	 * @method static File getModel()
	 * @method static File[] getModels(array $columns = ['*'])
	 * @method static _FileQueryBuilder getQuery()
	 * @method static _FileQueryBuilder groupBy(array $groups)
	 * @method static bool hasMacro(string $name)
	 * @method static _FileCollection|File[] hydrate(array $items)
	 * @method static int increment(string $column, float|int $amount = 1, array $extra = [])
	 * @method static bool insert(array $values)
	 * @method static int insertGetId(array $values, null|string $sequence = null)
	 * @method static int insertOrIgnore(array $values)
	 * @method static int insertUsing(array $columns, \Closure|\Illuminate\Database\Query\Builder|string $query)
	 * @method static _FileQueryBuilder join(string $table, \Closure|string $first, null|string $operator = null, null|string $second = null, string
	 *         $type = 'inner', bool $where = false)
	 * @method static _FileQueryBuilder latest(string $column = null)
	 * @method static _FileQueryBuilder leftJoin(string $table, \Closure|string $first, null|string $operator = null, null|string $second = null)
	 * @method static _FileQueryBuilder limit(int $value)
	 * @method static File make(array $attributes = [])
	 * @method static File newModelInstance(array $attributes = [])
	 * @method static int numericAggregate(string $function, array $columns = ['*'])
	 * @method static _FileQueryBuilder offset(int $value)
	 * @method static _FileQueryBuilder oldest(string $column = null)
	 * @method static _FileQueryBuilder orderBy(\Closure|\Illuminate\Database\Query\Builder|string $column, string $direction = 'asc')
	 * @method static _FileQueryBuilder orderByDesc(string $column)
	 * @method static _FileQueryBuilder orderByRaw(string $sql, array $bindings = [])
	 * @method static _FileQueryBuilder paginate(int $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
	 * @method static _FileQueryBuilder rightJoin(string $table, \Closure|string $first, null|string $operator = null, null|string $second = null)
	 * @method static _FileQueryBuilder select(array $columns = ['*'])
	 * @method static _FileQueryBuilder setQuery(\Illuminate\Database\Query\Builder $query)
	 * @method static _FileQueryBuilder simplePaginate(int $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
	 * @method static _FileQueryBuilder skip(int $value)
	 * @method static int sum(string $column)
	 * @method static _FileQueryBuilder take(int $value)
	 * @method static _FileQueryBuilder tap(callable $callback)
	 * @method static _FileQueryBuilder truncate()
	 * @method static _FileQueryBuilder unless($value, callable $callback, callable|null $default = null)
	 * @method static int update(array $values)
	 * @method static File updateOrCreate(array $attributes, array $values = [])
	 * @method static bool updateOrInsert(array $attributes, array $values = [])
	 * @method static _FileQueryBuilder when($value, callable $callback, callable|null $default = null)
	 * @method static _FileQueryBuilder where(array|\Closure|string $column, $operator = null, $value = null, string $boolean = 'and')
	 * @method static _FileQueryBuilder whereBetween(string $column, array $values, string $boolean = 'and', bool $not = false)
	 * @method static _FileQueryBuilder whereColumn(array|string $first, null|string $operator = null, null|string $second = null, null|string
	 *         $boolean = 'and')
	 * @method static _FileQueryBuilder whereDate(string $column, string $operator, \DateTimeInterface|null|string $value = null, string $boolean =
	 *         'and')
	 * @method static _FileQueryBuilder whereDay(string $column, string $operator, \DateTimeInterface|null|string $value = null, string $boolean =
	 *         'and')
	 * @method static _FileQueryBuilder whereDoesntHave(string $relation, \Closure $callback = null)
	 * @method static _FileQueryBuilder whereDoesntHaveMorph(string $relation, array|string $types, \Closure $callback = null)
	 * @method static _FileQueryBuilder whereExists(\Closure $callback, string $boolean = 'and', bool $not = false)
	 * @method static _FileQueryBuilder whereHas(string $relation, \Closure $callback = null, string $operator = '>=', int $count = 1)
	 * @method static _FileQueryBuilder whereHasMorph(string $relation, array|string $types, \Closure $callback = null, string $operator = '>=', int
	 *         $count = 1)
	 * @method static _FileQueryBuilder whereIn(string $column, $values, string $boolean = 'and', bool $not = false)
	 * @method static _FileQueryBuilder whereIntegerInRaw(string $column, array|Arrayable $values, string $boolean = 'and', bool $not = false)
	 * @method static _FileQueryBuilder whereIntegerNotInRaw(string $column, array|Arrayable $values, string $boolean = 'and')
	 * @method static _FileQueryBuilder whereJsonContains(string $column, $value, string $boolean = 'and', bool $not = false)
	 * @method static _FileQueryBuilder whereJsonDoesntContain(string $column, $value, string $boolean = 'and')
	 * @method static _FileQueryBuilder whereJsonLength(string $column, $operator, $value = null, string $boolean = 'and')
	 * @method static _FileQueryBuilder whereKey($id)
	 * @method static _FileQueryBuilder whereKeyNot($id)
	 * @method static _FileQueryBuilder whereMonth(string $column, string $operator, \DateTimeInterface|null|string $value = null, string $boolean =
	 *         'and')
	 * @method static _FileQueryBuilder whereNested(\Closure $callback, string $boolean = 'and')
	 * @method static _FileQueryBuilder whereNotBetween(string $column, array $values, string $boolean = 'and')
	 * @method static _FileQueryBuilder whereNotExists(\Closure $callback, string $boolean = 'and')
	 * @method static _FileQueryBuilder whereNotIn(string $column, $values, string $boolean = 'and')
	 * @method static _FileQueryBuilder whereNotNull(string $column, string $boolean = 'and')
	 * @method static _FileQueryBuilder whereNull(array|string $columns, string $boolean = 'and', bool $not = false)
	 * @method static _FileQueryBuilder whereRaw(string $sql, $bindings = [], string $boolean = 'and')
	 * @method static _FileQueryBuilder whereRowValues(array $columns, string $operator, array $values, string $boolean = 'and')
	 * @method static _FileQueryBuilder whereTime(string $column, string $operator, \DateTimeInterface|null|string $value = null, string $boolean =
	 *         'and')
	 * @method static _FileQueryBuilder whereYear(string $column, string $operator, \DateTimeInterface|int|null|string $value = null, string $boolean
	 *         = 'and')
	 * @method static _FileQueryBuilder with($relations)
	 * @method static _FileQueryBuilder withCount($relations)
	 * @method static _FileQueryBuilder withGlobalScope(string $identifier, \Closure|Scope $scope)
	 * @method static _FileQueryBuilder without($relations)
	 * @method static _FileQueryBuilder withoutGlobalScope(Scope|string $scope)
	 * @method static _FileQueryBuilder withoutGlobalScopes(array $scopes = null)
	 */
	class File extends Model
	{
	}

	/**
	 * @property int         $id
	 * @property int         $file_id
	 * @property int         $user_id
	 * @property Carbon|null $created_at
	 * @property Carbon|null $updated_at
	 * @method _FileFavouriteQueryBuilder newModelQuery()
	 * @method _FileFavouriteQueryBuilder newQuery()
	 * @method static _FileFavouriteQueryBuilder query()
	 * @method static _FileFavouriteCollection|FileFavourite[] all()
	 * @method static _FileFavouriteQueryBuilder whereId($value)
	 * @method static _FileFavouriteQueryBuilder whereFileId($value)
	 * @method static _FileFavouriteQueryBuilder whereUserId($value)
	 * @method static _FileFavouriteQueryBuilder whereCreatedAt($value)
	 * @method static _FileFavouriteQueryBuilder whereUpdatedAt($value)
	 * @method static bool chunk(int $count, callable $callback)
	 * @method static bool chunkById(int $count, callable $callback, null|string $column = null, null|string $alias = null)
	 * @method static int count(string $columns = '*')
	 * @method static FileFavourite create(array $attributes = [])
	 * @method static _FileFavouriteQueryBuilder crossJoin(string $table, \Closure|null|string $first = null, null|string $operator = null,
	 *         null|string $second = null)
	 * @method static _FileFavouriteCollection|FileFavourite[] cursor()
	 * @method static int decrement(string $column, float|int $amount = 1, array $extra = [])
	 * @method static bool doesntExist()
	 * @method static _FileFavouriteQueryBuilder each(callable $callback, int $count = 1000)
	 * @method static bool eachById(callable $callback, int $count = 1000, string $column = null, string $alias = null)
	 * @method static bool exists()
	 * @method static FileFavourite|null find($id, array $columns = ['*'])
	 * @method static _FileFavouriteCollection|FileFavourite[] findMany(array|Arrayable $ids, array $columns = ['*'])
	 * @method static FileFavourite findOrFail($id, array $columns = ['*'])
	 * @method static _FileFavouriteCollection|FileFavourite[] findOrNew($id, array $columns = ['*'])
	 * @method static FileFavourite first(array $columns = ['*'])
	 * @method static FileFavourite firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
	 * @method static FileFavourite firstOrCreate(array $attributes, array $values = [])
	 * @method static FileFavourite firstOrFail(array $columns = ['*'])
	 * @method static FileFavourite firstOrNew(array $attributes, array $values = [])
	 * @method static FileFavourite forceCreate(array $attributes)
	 * @method static _FileFavouriteCollection|FileFavourite[] fromQuery(string $query, array $bindings = [])
	 * @method static _FileFavouriteCollection|FileFavourite[] get(array $columns = ['*'])
	 * @method static int getCountForPagination(array $columns = ['*'])
	 * @method static FileFavourite getModel()
	 * @method static FileFavourite[] getModels(array $columns = ['*'])
	 * @method static _FileFavouriteQueryBuilder getQuery()
	 * @method static _FileFavouriteQueryBuilder groupBy(array $groups)
	 * @method static bool hasMacro(string $name)
	 * @method static _FileFavouriteCollection|FileFavourite[] hydrate(array $items)
	 * @method static int increment(string $column, float|int $amount = 1, array $extra = [])
	 * @method static bool insert(array $values)
	 * @method static int insertGetId(array $values, null|string $sequence = null)
	 * @method static int insertOrIgnore(array $values)
	 * @method static int insertUsing(array $columns, \Closure|\Illuminate\Database\Query\Builder|string $query)
	 * @method static _FileFavouriteQueryBuilder join(string $table, \Closure|string $first, null|string $operator = null, null|string $second =
	 *         null, string $type = 'inner', bool $where = false)
	 * @method static _FileFavouriteQueryBuilder latest(string $column = null)
	 * @method static _FileFavouriteQueryBuilder leftJoin(string $table, \Closure|string $first, null|string $operator = null, null|string $second =
	 *         null)
	 * @method static _FileFavouriteQueryBuilder limit(int $value)
	 * @method static FileFavourite make(array $attributes = [])
	 * @method static FileFavourite newModelInstance(array $attributes = [])
	 * @method static int numericAggregate(string $function, array $columns = ['*'])
	 * @method static _FileFavouriteQueryBuilder offset(int $value)
	 * @method static _FileFavouriteQueryBuilder oldest(string $column = null)
	 * @method static _FileFavouriteQueryBuilder orderBy(\Closure|\Illuminate\Database\Query\Builder|string $column, string $direction = 'asc')
	 * @method static _FileFavouriteQueryBuilder orderByDesc(string $column)
	 * @method static _FileFavouriteQueryBuilder orderByRaw(string $sql, array $bindings = [])
	 * @method static _FileFavouriteQueryBuilder paginate(int $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page =
	 *         null)
	 * @method static _FileFavouriteQueryBuilder rightJoin(string $table, \Closure|string $first, null|string $operator = null, null|string $second =
	 *         null)
	 * @method static _FileFavouriteQueryBuilder select(array $columns = ['*'])
	 * @method static _FileFavouriteQueryBuilder setQuery(\Illuminate\Database\Query\Builder $query)
	 * @method static _FileFavouriteQueryBuilder simplePaginate(int $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null
	 *         $page = null)
	 * @method static _FileFavouriteQueryBuilder skip(int $value)
	 * @method static int sum(string $column)
	 * @method static _FileFavouriteQueryBuilder take(int $value)
	 * @method static _FileFavouriteQueryBuilder tap(callable $callback)
	 * @method static _FileFavouriteQueryBuilder truncate()
	 * @method static _FileFavouriteQueryBuilder unless($value, callable $callback, callable|null $default = null)
	 * @method static int update(array $values)
	 * @method static FileFavourite updateOrCreate(array $attributes, array $values = [])
	 * @method static bool updateOrInsert(array $attributes, array $values = [])
	 * @method static _FileFavouriteQueryBuilder when($value, callable $callback, callable|null $default = null)
	 * @method static _FileFavouriteQueryBuilder where(array|\Closure|string $column, $operator = null, $value = null, string $boolean = 'and')
	 * @method static _FileFavouriteQueryBuilder whereBetween(string $column, array $values, string $boolean = 'and', bool $not = false)
	 * @method static _FileFavouriteQueryBuilder whereColumn(array|string $first, null|string $operator = null, null|string $second = null,
	 *         null|string $boolean = 'and')
	 * @method static _FileFavouriteQueryBuilder whereDate(string $column, string $operator, \DateTimeInterface|null|string $value = null, string
	 *         $boolean = 'and')
	 * @method static _FileFavouriteQueryBuilder whereDay(string $column, string $operator, \DateTimeInterface|null|string $value = null, string
	 *         $boolean = 'and')
	 * @method static _FileFavouriteQueryBuilder whereDoesntHave(string $relation, \Closure $callback = null)
	 * @method static _FileFavouriteQueryBuilder whereDoesntHaveMorph(string $relation, array|string $types, \Closure $callback = null)
	 * @method static _FileFavouriteQueryBuilder whereExists(\Closure $callback, string $boolean = 'and', bool $not = false)
	 * @method static _FileFavouriteQueryBuilder whereHas(string $relation, \Closure $callback = null, string $operator = '>=', int $count = 1)
	 * @method static _FileFavouriteQueryBuilder whereHasMorph(string $relation, array|string $types, \Closure $callback = null, string $operator =
	 *         '>=', int $count = 1)
	 * @method static _FileFavouriteQueryBuilder whereIn(string $column, $values, string $boolean = 'and', bool $not = false)
	 * @method static _FileFavouriteQueryBuilder whereIntegerInRaw(string $column, array|Arrayable $values, string $boolean = 'and', bool $not =
	 *         false)
	 * @method static _FileFavouriteQueryBuilder whereIntegerNotInRaw(string $column, array|Arrayable $values, string $boolean = 'and')
	 * @method static _FileFavouriteQueryBuilder whereJsonContains(string $column, $value, string $boolean = 'and', bool $not = false)
	 * @method static _FileFavouriteQueryBuilder whereJsonDoesntContain(string $column, $value, string $boolean = 'and')
	 * @method static _FileFavouriteQueryBuilder whereJsonLength(string $column, $operator, $value = null, string $boolean = 'and')
	 * @method static _FileFavouriteQueryBuilder whereKey($id)
	 * @method static _FileFavouriteQueryBuilder whereKeyNot($id)
	 * @method static _FileFavouriteQueryBuilder whereMonth(string $column, string $operator, \DateTimeInterface|null|string $value = null, string
	 *         $boolean = 'and')
	 * @method static _FileFavouriteQueryBuilder whereNested(\Closure $callback, string $boolean = 'and')
	 * @method static _FileFavouriteQueryBuilder whereNotBetween(string $column, array $values, string $boolean = 'and')
	 * @method static _FileFavouriteQueryBuilder whereNotExists(\Closure $callback, string $boolean = 'and')
	 * @method static _FileFavouriteQueryBuilder whereNotIn(string $column, $values, string $boolean = 'and')
	 * @method static _FileFavouriteQueryBuilder whereNotNull(string $column, string $boolean = 'and')
	 * @method static _FileFavouriteQueryBuilder whereNull(array|string $columns, string $boolean = 'and', bool $not = false)
	 * @method static _FileFavouriteQueryBuilder whereRaw(string $sql, $bindings = [], string $boolean = 'and')
	 * @method static _FileFavouriteQueryBuilder whereRowValues(array $columns, string $operator, array $values, string $boolean = 'and')
	 * @method static _FileFavouriteQueryBuilder whereTime(string $column, string $operator, \DateTimeInterface|null|string $value = null, string
	 *         $boolean = 'and')
	 * @method static _FileFavouriteQueryBuilder whereYear(string $column, string $operator, \DateTimeInterface|int|null|string $value = null, string
	 *         $boolean = 'and')
	 * @method static _FileFavouriteQueryBuilder with($relations)
	 * @method static _FileFavouriteQueryBuilder withCount($relations)
	 * @method static _FileFavouriteQueryBuilder withGlobalScope(string $identifier, \Closure|Scope $scope)
	 * @method static _FileFavouriteQueryBuilder without($relations)
	 * @method static _FileFavouriteQueryBuilder withoutGlobalScope(Scope|string $scope)
	 * @method static _FileFavouriteQueryBuilder withoutGlobalScopes(array $scopes = null)
	 */
	class FileFavourite extends Model
	{
	}

	/**
	 * @property int         $id
	 * @property int         $file_id
	 * @property string      $ip
	 * @property Carbon|null $created_at
	 * @property Carbon|null $updated_at
	 * @property File        $file
	 * @method BelongsTo|_FileQueryBuilder file()
	 * @method _FileViewQueryBuilder newModelQuery()
	 * @method _FileViewQueryBuilder newQuery()
	 * @method static _FileViewQueryBuilder query()
	 * @method static _FileViewCollection|FileView[] all()
	 * @method static _FileViewQueryBuilder whereId($value)
	 * @method static _FileViewQueryBuilder whereFileId($value)
	 * @method static _FileViewQueryBuilder whereIp($value)
	 * @method static _FileViewQueryBuilder whereCreatedAt($value)
	 * @method static _FileViewQueryBuilder whereUpdatedAt($value)
	 * @method static bool chunk(int $count, callable $callback)
	 * @method static bool chunkById(int $count, callable $callback, null|string $column = null, null|string $alias = null)
	 * @method static int count(string $columns = '*')
	 * @method static FileView create(array $attributes = [])
	 * @method static _FileViewQueryBuilder crossJoin(string $table, \Closure|null|string $first = null, null|string $operator = null, null|string
	 *         $second = null)
	 * @method static _FileViewCollection|FileView[] cursor()
	 * @method static int decrement(string $column, float|int $amount = 1, array $extra = [])
	 * @method static bool doesntExist()
	 * @method static _FileViewQueryBuilder each(callable $callback, int $count = 1000)
	 * @method static bool eachById(callable $callback, int $count = 1000, string $column = null, string $alias = null)
	 * @method static bool exists()
	 * @method static FileView|null find($id, array $columns = ['*'])
	 * @method static _FileViewCollection|FileView[] findMany(array|Arrayable $ids, array $columns = ['*'])
	 * @method static FileView findOrFail($id, array $columns = ['*'])
	 * @method static _FileViewCollection|FileView[] findOrNew($id, array $columns = ['*'])
	 * @method static FileView first(array $columns = ['*'])
	 * @method static FileView firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
	 * @method static FileView firstOrCreate(array $attributes, array $values = [])
	 * @method static FileView firstOrFail(array $columns = ['*'])
	 * @method static FileView firstOrNew(array $attributes, array $values = [])
	 * @method static FileView forceCreate(array $attributes)
	 * @method static _FileViewCollection|FileView[] fromQuery(string $query, array $bindings = [])
	 * @method static _FileViewCollection|FileView[] get(array $columns = ['*'])
	 * @method static int getCountForPagination(array $columns = ['*'])
	 * @method static FileView getModel()
	 * @method static FileView[] getModels(array $columns = ['*'])
	 * @method static _FileViewQueryBuilder getQuery()
	 * @method static _FileViewQueryBuilder groupBy(array $groups)
	 * @method static bool hasMacro(string $name)
	 * @method static _FileViewCollection|FileView[] hydrate(array $items)
	 * @method static int increment(string $column, float|int $amount = 1, array $extra = [])
	 * @method static bool insert(array $values)
	 * @method static int insertGetId(array $values, null|string $sequence = null)
	 * @method static int insertOrIgnore(array $values)
	 * @method static int insertUsing(array $columns, \Closure|\Illuminate\Database\Query\Builder|string $query)
	 * @method static _FileViewQueryBuilder join(string $table, \Closure|string $first, null|string $operator = null, null|string $second = null,
	 *         string $type = 'inner', bool $where = false)
	 * @method static _FileViewQueryBuilder latest(string $column = null)
	 * @method static _FileViewQueryBuilder leftJoin(string $table, \Closure|string $first, null|string $operator = null, null|string $second = null)
	 * @method static _FileViewQueryBuilder limit(int $value)
	 * @method static FileView make(array $attributes = [])
	 * @method static FileView newModelInstance(array $attributes = [])
	 * @method static int numericAggregate(string $function, array $columns = ['*'])
	 * @method static _FileViewQueryBuilder offset(int $value)
	 * @method static _FileViewQueryBuilder oldest(string $column = null)
	 * @method static _FileViewQueryBuilder orderBy(\Closure|\Illuminate\Database\Query\Builder|string $column, string $direction = 'asc')
	 * @method static _FileViewQueryBuilder orderByDesc(string $column)
	 * @method static _FileViewQueryBuilder orderByRaw(string $sql, array $bindings = [])
	 * @method static _FileViewQueryBuilder paginate(int $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
	 * @method static _FileViewQueryBuilder rightJoin(string $table, \Closure|string $first, null|string $operator = null, null|string $second =
	 *         null)
	 * @method static _FileViewQueryBuilder select(array $columns = ['*'])
	 * @method static _FileViewQueryBuilder setQuery(\Illuminate\Database\Query\Builder $query)
	 * @method static _FileViewQueryBuilder simplePaginate(int $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page =
	 *         null)
	 * @method static _FileViewQueryBuilder skip(int $value)
	 * @method static int sum(string $column)
	 * @method static _FileViewQueryBuilder take(int $value)
	 * @method static _FileViewQueryBuilder tap(callable $callback)
	 * @method static _FileViewQueryBuilder truncate()
	 * @method static _FileViewQueryBuilder unless($value, callable $callback, callable|null $default = null)
	 * @method static int update(array $values)
	 * @method static FileView updateOrCreate(array $attributes, array $values = [])
	 * @method static bool updateOrInsert(array $attributes, array $values = [])
	 * @method static _FileViewQueryBuilder when($value, callable $callback, callable|null $default = null)
	 * @method static _FileViewQueryBuilder where(array|\Closure|string $column, $operator = null, $value = null, string $boolean = 'and')
	 * @method static _FileViewQueryBuilder whereBetween(string $column, array $values, string $boolean = 'and', bool $not = false)
	 * @method static _FileViewQueryBuilder whereColumn(array|string $first, null|string $operator = null, null|string $second = null, null|string
	 *         $boolean = 'and')
	 * @method static _FileViewQueryBuilder whereDate(string $column, string $operator, \DateTimeInterface|null|string $value = null, string $boolean
	 *         = 'and')
	 * @method static _FileViewQueryBuilder whereDay(string $column, string $operator, \DateTimeInterface|null|string $value = null, string $boolean
	 *         = 'and')
	 * @method static _FileViewQueryBuilder whereDoesntHave(string $relation, \Closure $callback = null)
	 * @method static _FileViewQueryBuilder whereDoesntHaveMorph(string $relation, array|string $types, \Closure $callback = null)
	 * @method static _FileViewQueryBuilder whereExists(\Closure $callback, string $boolean = 'and', bool $not = false)
	 * @method static _FileViewQueryBuilder whereHas(string $relation, \Closure $callback = null, string $operator = '>=', int $count = 1)
	 * @method static _FileViewQueryBuilder whereHasMorph(string $relation, array|string $types, \Closure $callback = null, string $operator = '>=',
	 *         int $count = 1)
	 * @method static _FileViewQueryBuilder whereIn(string $column, $values, string $boolean = 'and', bool $not = false)
	 * @method static _FileViewQueryBuilder whereIntegerInRaw(string $column, array|Arrayable $values, string $boolean = 'and', bool $not = false)
	 * @method static _FileViewQueryBuilder whereIntegerNotInRaw(string $column, array|Arrayable $values, string $boolean = 'and')
	 * @method static _FileViewQueryBuilder whereJsonContains(string $column, $value, string $boolean = 'and', bool $not = false)
	 * @method static _FileViewQueryBuilder whereJsonDoesntContain(string $column, $value, string $boolean = 'and')
	 * @method static _FileViewQueryBuilder whereJsonLength(string $column, $operator, $value = null, string $boolean = 'and')
	 * @method static _FileViewQueryBuilder whereKey($id)
	 * @method static _FileViewQueryBuilder whereKeyNot($id)
	 * @method static _FileViewQueryBuilder whereMonth(string $column, string $operator, \DateTimeInterface|null|string $value = null, string
	 *         $boolean = 'and')
	 * @method static _FileViewQueryBuilder whereNested(\Closure $callback, string $boolean = 'and')
	 * @method static _FileViewQueryBuilder whereNotBetween(string $column, array $values, string $boolean = 'and')
	 * @method static _FileViewQueryBuilder whereNotExists(\Closure $callback, string $boolean = 'and')
	 * @method static _FileViewQueryBuilder whereNotIn(string $column, $values, string $boolean = 'and')
	 * @method static _FileViewQueryBuilder whereNotNull(string $column, string $boolean = 'and')
	 * @method static _FileViewQueryBuilder whereNull(array|string $columns, string $boolean = 'and', bool $not = false)
	 * @method static _FileViewQueryBuilder whereRaw(string $sql, $bindings = [], string $boolean = 'and')
	 * @method static _FileViewQueryBuilder whereRowValues(array $columns, string $operator, array $values, string $boolean = 'and')
	 * @method static _FileViewQueryBuilder whereTime(string $column, string $operator, \DateTimeInterface|null|string $value = null, string $boolean
	 *         = 'and')
	 * @method static _FileViewQueryBuilder whereYear(string $column, string $operator, \DateTimeInterface|int|null|string $value = null, string
	 *         $boolean = 'and')
	 * @method static _FileViewQueryBuilder with($relations)
	 * @method static _FileViewQueryBuilder withCount($relations)
	 * @method static _FileViewQueryBuilder withGlobalScope(string $identifier, \Closure|Scope $scope)
	 * @method static _FileViewQueryBuilder without($relations)
	 * @method static _FileViewQueryBuilder withoutGlobalScope(Scope|string $scope)
	 * @method static _FileViewQueryBuilder withoutGlobalScopes(array $scopes = null)
	 */
	class FileView extends Model
	{
	}

	/**
	 * @property int                                                    $id
	 * @property string                                                 $name
	 * @property string                                                 $email
	 * @property Carbon|null                                            $email_verified_at
	 * @property string                                                 $password
	 * @property bool                                                   $private_uploads
	 * @property string|null                                            $remember_token
	 * @property Carbon|null                                            $created_at
	 * @property Carbon|null                                            $updated_at
	 * @property string|null                                            $webhook_url
	 * @property string|null                                            $webhook_key
	 * @property bool                                                   $low_def_only
	 * @property _FileCollection|File[]                                 $favouriteFiles
	 * @method HasManyThrough|_FileQueryBuilder favouriteFiles()
	 * @property _FileCollection|File[]                                 $files
	 * @method HasMany|_FileQueryBuilder files()
	 * @property _DatabaseNotificationCollection|DatabaseNotification[] $notifications
	 * @method MorphToMany|_DatabaseNotificationQueryBuilder notifications()
	 * @method _UserQueryBuilder newModelQuery()
	 * @method _UserQueryBuilder newQuery()
	 * @method static _UserQueryBuilder query()
	 * @method static _UserCollection|User[] all()
	 * @method static _UserQueryBuilder whereId($value)
	 * @method static _UserQueryBuilder whereName($value)
	 * @method static _UserQueryBuilder whereEmail($value)
	 * @method static _UserQueryBuilder whereEmailVerifiedAt($value)
	 * @method static _UserQueryBuilder wherePassword($value)
	 * @method static _UserQueryBuilder wherePrivateUploads($value)
	 * @method static _UserQueryBuilder whereRememberToken($value)
	 * @method static _UserQueryBuilder whereCreatedAt($value)
	 * @method static _UserQueryBuilder whereUpdatedAt($value)
	 * @method static _UserQueryBuilder whereWebhookUrl($value)
	 * @method static _UserQueryBuilder whereWebhookKey($value)
	 * @method static _UserQueryBuilder whereLowDefOnly($value)
	 * @method static bool chunk(int $count, callable $callback)
	 * @method static bool chunkById(int $count, callable $callback, null|string $column = null, null|string $alias = null)
	 * @method static int count(string $columns = '*')
	 * @method static User create(array $attributes = [])
	 * @method static _UserQueryBuilder crossJoin(string $table, \Closure|null|string $first = null, null|string $operator = null, null|string
	 *         $second = null)
	 * @method static _UserCollection|User[] cursor()
	 * @method static int decrement(string $column, float|int $amount = 1, array $extra = [])
	 * @method static bool doesntExist()
	 * @method static _UserQueryBuilder each(callable $callback, int $count = 1000)
	 * @method static bool eachById(callable $callback, int $count = 1000, string $column = null, string $alias = null)
	 * @method static bool exists()
	 * @method static User|null find($id, array $columns = ['*'])
	 * @method static _UserCollection|User[] findMany(array|Arrayable $ids, array $columns = ['*'])
	 * @method static User findOrFail($id, array $columns = ['*'])
	 * @method static _UserCollection|User[] findOrNew($id, array $columns = ['*'])
	 * @method static User first(array $columns = ['*'])
	 * @method static User firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
	 * @method static User firstOrCreate(array $attributes, array $values = [])
	 * @method static User firstOrFail(array $columns = ['*'])
	 * @method static User firstOrNew(array $attributes, array $values = [])
	 * @method static User forceCreate(array $attributes)
	 * @method static _UserCollection|User[] fromQuery(string $query, array $bindings = [])
	 * @method static _UserCollection|User[] get(array $columns = ['*'])
	 * @method static int getCountForPagination(array $columns = ['*'])
	 * @method static User getModel()
	 * @method static User[] getModels(array $columns = ['*'])
	 * @method static _UserQueryBuilder getQuery()
	 * @method static _UserQueryBuilder groupBy(array $groups)
	 * @method static bool hasMacro(string $name)
	 * @method static _UserCollection|User[] hydrate(array $items)
	 * @method static int increment(string $column, float|int $amount = 1, array $extra = [])
	 * @method static bool insert(array $values)
	 * @method static int insertGetId(array $values, null|string $sequence = null)
	 * @method static int insertOrIgnore(array $values)
	 * @method static int insertUsing(array $columns, \Closure|\Illuminate\Database\Query\Builder|string $query)
	 * @method static _UserQueryBuilder join(string $table, \Closure|string $first, null|string $operator = null, null|string $second = null, string
	 *         $type = 'inner', bool $where = false)
	 * @method static _UserQueryBuilder latest(string $column = null)
	 * @method static _UserQueryBuilder leftJoin(string $table, \Closure|string $first, null|string $operator = null, null|string $second = null)
	 * @method static _UserQueryBuilder limit(int $value)
	 * @method static User make(array $attributes = [])
	 * @method static User newModelInstance(array $attributes = [])
	 * @method static int numericAggregate(string $function, array $columns = ['*'])
	 * @method static _UserQueryBuilder offset(int $value)
	 * @method static _UserQueryBuilder oldest(string $column = null)
	 * @method static _UserQueryBuilder orderBy(\Closure|\Illuminate\Database\Query\Builder|string $column, string $direction = 'asc')
	 * @method static _UserQueryBuilder orderByDesc(string $column)
	 * @method static _UserQueryBuilder orderByRaw(string $sql, array $bindings = [])
	 * @method static _UserQueryBuilder paginate(int $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
	 * @method static _UserQueryBuilder rightJoin(string $table, \Closure|string $first, null|string $operator = null, null|string $second = null)
	 * @method static _UserQueryBuilder select(array $columns = ['*'])
	 * @method static _UserQueryBuilder setQuery(\Illuminate\Database\Query\Builder $query)
	 * @method static _UserQueryBuilder simplePaginate(int $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
	 * @method static _UserQueryBuilder skip(int $value)
	 * @method static int sum(string $column)
	 * @method static _UserQueryBuilder take(int $value)
	 * @method static _UserQueryBuilder tap(callable $callback)
	 * @method static _UserQueryBuilder truncate()
	 * @method static _UserQueryBuilder unless($value, callable $callback, callable|null $default = null)
	 * @method static int update(array $values)
	 * @method static User updateOrCreate(array $attributes, array $values = [])
	 * @method static bool updateOrInsert(array $attributes, array $values = [])
	 * @method static _UserQueryBuilder when($value, callable $callback, callable|null $default = null)
	 * @method static _UserQueryBuilder where(array|\Closure|string $column, $operator = null, $value = null, string $boolean = 'and')
	 * @method static _UserQueryBuilder whereBetween(string $column, array $values, string $boolean = 'and', bool $not = false)
	 * @method static _UserQueryBuilder whereColumn(array|string $first, null|string $operator = null, null|string $second = null, null|string
	 *         $boolean = 'and')
	 * @method static _UserQueryBuilder whereDate(string $column, string $operator, \DateTimeInterface|null|string $value = null, string $boolean =
	 *         'and')
	 * @method static _UserQueryBuilder whereDay(string $column, string $operator, \DateTimeInterface|null|string $value = null, string $boolean =
	 *         'and')
	 * @method static _UserQueryBuilder whereDoesntHave(string $relation, \Closure $callback = null)
	 * @method static _UserQueryBuilder whereDoesntHaveMorph(string $relation, array|string $types, \Closure $callback = null)
	 * @method static _UserQueryBuilder whereExists(\Closure $callback, string $boolean = 'and', bool $not = false)
	 * @method static _UserQueryBuilder whereHas(string $relation, \Closure $callback = null, string $operator = '>=', int $count = 1)
	 * @method static _UserQueryBuilder whereHasMorph(string $relation, array|string $types, \Closure $callback = null, string $operator = '>=', int
	 *         $count = 1)
	 * @method static _UserQueryBuilder whereIn(string $column, $values, string $boolean = 'and', bool $not = false)
	 * @method static _UserQueryBuilder whereIntegerInRaw(string $column, array|Arrayable $values, string $boolean = 'and', bool $not = false)
	 * @method static _UserQueryBuilder whereIntegerNotInRaw(string $column, array|Arrayable $values, string $boolean = 'and')
	 * @method static _UserQueryBuilder whereJsonContains(string $column, $value, string $boolean = 'and', bool $not = false)
	 * @method static _UserQueryBuilder whereJsonDoesntContain(string $column, $value, string $boolean = 'and')
	 * @method static _UserQueryBuilder whereJsonLength(string $column, $operator, $value = null, string $boolean = 'and')
	 * @method static _UserQueryBuilder whereKey($id)
	 * @method static _UserQueryBuilder whereKeyNot($id)
	 * @method static _UserQueryBuilder whereMonth(string $column, string $operator, \DateTimeInterface|null|string $value = null, string $boolean =
	 *         'and')
	 * @method static _UserQueryBuilder whereNested(\Closure $callback, string $boolean = 'and')
	 * @method static _UserQueryBuilder whereNotBetween(string $column, array $values, string $boolean = 'and')
	 * @method static _UserQueryBuilder whereNotExists(\Closure $callback, string $boolean = 'and')
	 * @method static _UserQueryBuilder whereNotIn(string $column, $values, string $boolean = 'and')
	 * @method static _UserQueryBuilder whereNotNull(string $column, string $boolean = 'and')
	 * @method static _UserQueryBuilder whereNull(array|string $columns, string $boolean = 'and', bool $not = false)
	 * @method static _UserQueryBuilder whereRaw(string $sql, $bindings = [], string $boolean = 'and')
	 * @method static _UserQueryBuilder whereRowValues(array $columns, string $operator, array $values, string $boolean = 'and')
	 * @method static _UserQueryBuilder whereTime(string $column, string $operator, \DateTimeInterface|null|string $value = null, string $boolean =
	 *         'and')
	 * @method static _UserQueryBuilder whereYear(string $column, string $operator, \DateTimeInterface|int|null|string $value = null, string $boolean
	 *         = 'and')
	 * @method static _UserQueryBuilder with($relations)
	 * @method static _UserQueryBuilder withCount($relations)
	 * @method static _UserQueryBuilder withGlobalScope(string $identifier, \Closure|Scope $scope)
	 * @method static _UserQueryBuilder without($relations)
	 * @method static _UserQueryBuilder withoutGlobalScope(Scope|string $scope)
	 * @method static _UserQueryBuilder withoutGlobalScopes(array $scopes = null)
	 */
	class User extends Model
	{
	}
}

namespace Illuminate\Notifications
{

	use Illuminate\Contracts\Support\Arrayable;
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Eloquent\Scope;
	use LaravelIdea\Helper\Illuminate\Notifications\_DatabaseNotificationCollection;
	use LaravelIdea\Helper\Illuminate\Notifications\_DatabaseNotificationQueryBuilder;

	/**
	 * @method _DatabaseNotificationQueryBuilder newModelQuery()
	 * @method _DatabaseNotificationQueryBuilder newQuery()
	 * @method static _DatabaseNotificationQueryBuilder query()
	 * @method static _DatabaseNotificationCollection|DatabaseNotification[] all()
	 * @method static bool chunk(int $count, callable $callback)
	 * @method static bool chunkById(int $count, callable $callback, null|string $column = null, null|string $alias = null)
	 * @method static int count(string $columns = '*')
	 * @method static DatabaseNotification create(array $attributes = [])
	 * @method static _DatabaseNotificationQueryBuilder crossJoin(string $table, \Closure|null|string $first = null, null|string $operator = null,
	 *         null|string $second = null)
	 * @method static _DatabaseNotificationCollection|DatabaseNotification[] cursor()
	 * @method static int decrement(string $column, float|int $amount = 1, array $extra = [])
	 * @method static bool doesntExist()
	 * @method static _DatabaseNotificationQueryBuilder each(callable $callback, int $count = 1000)
	 * @method static bool eachById(callable $callback, int $count = 1000, string $column = null, string $alias = null)
	 * @method static bool exists()
	 * @method static DatabaseNotification|null find($id, array $columns = ['*'])
	 * @method static _DatabaseNotificationCollection|DatabaseNotification[] findMany(array|Arrayable $ids, array $columns = ['*'])
	 * @method static DatabaseNotification findOrFail($id, array $columns = ['*'])
	 * @method static _DatabaseNotificationCollection|DatabaseNotification[] findOrNew($id, array $columns = ['*'])
	 * @method static DatabaseNotification first(array $columns = ['*'])
	 * @method static DatabaseNotification firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
	 * @method static DatabaseNotification firstOrCreate(array $attributes, array $values = [])
	 * @method static DatabaseNotification firstOrFail(array $columns = ['*'])
	 * @method static DatabaseNotification firstOrNew(array $attributes, array $values = [])
	 * @method static DatabaseNotification forceCreate(array $attributes)
	 * @method static _DatabaseNotificationCollection|DatabaseNotification[] fromQuery(string $query, array $bindings = [])
	 * @method static _DatabaseNotificationCollection|DatabaseNotification[] get(array $columns = ['*'])
	 * @method static int getCountForPagination(array $columns = ['*'])
	 * @method static DatabaseNotification getModel()
	 * @method static DatabaseNotification[] getModels(array $columns = ['*'])
	 * @method static _DatabaseNotificationQueryBuilder getQuery()
	 * @method static _DatabaseNotificationQueryBuilder groupBy(array $groups)
	 * @method static bool hasMacro(string $name)
	 * @method static _DatabaseNotificationCollection|DatabaseNotification[] hydrate(array $items)
	 * @method static int increment(string $column, float|int $amount = 1, array $extra = [])
	 * @method static bool insert(array $values)
	 * @method static int insertGetId(array $values, null|string $sequence = null)
	 * @method static int insertOrIgnore(array $values)
	 * @method static int insertUsing(array $columns, \Closure|\Illuminate\Database\Query\Builder|string $query)
	 * @method static _DatabaseNotificationQueryBuilder join(string $table, \Closure|string $first, null|string $operator = null, null|string $second
	 *         = null, string $type = 'inner', bool $where = false)
	 * @method static _DatabaseNotificationQueryBuilder latest(string $column = null)
	 * @method static _DatabaseNotificationQueryBuilder leftJoin(string $table, \Closure|string $first, null|string $operator = null, null|string
	 *         $second = null)
	 * @method static _DatabaseNotificationQueryBuilder limit(int $value)
	 * @method static DatabaseNotification make(array $attributes = [])
	 * @method static DatabaseNotification newModelInstance(array $attributes = [])
	 * @method static int numericAggregate(string $function, array $columns = ['*'])
	 * @method static _DatabaseNotificationQueryBuilder offset(int $value)
	 * @method static _DatabaseNotificationQueryBuilder oldest(string $column = null)
	 * @method static _DatabaseNotificationQueryBuilder orderBy(\Closure|\Illuminate\Database\Query\Builder|string $column, string $direction =
	 *         'asc')
	 * @method static _DatabaseNotificationQueryBuilder orderByDesc(string $column)
	 * @method static _DatabaseNotificationQueryBuilder orderByRaw(string $sql, array $bindings = [])
	 * @method static _DatabaseNotificationQueryBuilder paginate(int $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null
	 *         $page = null)
	 * @method static _DatabaseNotificationQueryBuilder rightJoin(string $table, \Closure|string $first, null|string $operator = null, null|string
	 *         $second = null)
	 * @method static _DatabaseNotificationQueryBuilder select(array $columns = ['*'])
	 * @method static _DatabaseNotificationQueryBuilder setQuery(\Illuminate\Database\Query\Builder $query)
	 * @method static _DatabaseNotificationQueryBuilder simplePaginate(int $perPage = null, array $columns = ['*'], string $pageName = 'page',
	 *         int|null $page = null)
	 * @method static _DatabaseNotificationQueryBuilder skip(int $value)
	 * @method static int sum(string $column)
	 * @method static _DatabaseNotificationQueryBuilder take(int $value)
	 * @method static _DatabaseNotificationQueryBuilder tap(callable $callback)
	 * @method static _DatabaseNotificationQueryBuilder truncate()
	 * @method static _DatabaseNotificationQueryBuilder unless($value, callable $callback, callable|null $default = null)
	 * @method static int update(array $values)
	 * @method static DatabaseNotification updateOrCreate(array $attributes, array $values = [])
	 * @method static bool updateOrInsert(array $attributes, array $values = [])
	 * @method static _DatabaseNotificationQueryBuilder when($value, callable $callback, callable|null $default = null)
	 * @method static _DatabaseNotificationQueryBuilder where(array|\Closure|string $column, $operator = null, $value = null, string $boolean =
	 *         'and')
	 * @method static _DatabaseNotificationQueryBuilder whereBetween(string $column, array $values, string $boolean = 'and', bool $not = false)
	 * @method static _DatabaseNotificationQueryBuilder whereColumn(array|string $first, null|string $operator = null, null|string $second = null,
	 *         null|string $boolean = 'and')
	 * @method static _DatabaseNotificationQueryBuilder whereDate(string $column, string $operator, \DateTimeInterface|null|string $value = null,
	 *         string $boolean = 'and')
	 * @method static _DatabaseNotificationQueryBuilder whereDay(string $column, string $operator, \DateTimeInterface|null|string $value = null,
	 *         string $boolean = 'and')
	 * @method static _DatabaseNotificationQueryBuilder whereDoesntHave(string $relation, \Closure $callback = null)
	 * @method static _DatabaseNotificationQueryBuilder whereDoesntHaveMorph(string $relation, array|string $types, \Closure $callback = null)
	 * @method static _DatabaseNotificationQueryBuilder whereExists(\Closure $callback, string $boolean = 'and', bool $not = false)
	 * @method static _DatabaseNotificationQueryBuilder whereHas(string $relation, \Closure $callback = null, string $operator = '>=', int $count =
	 *         1)
	 * @method static _DatabaseNotificationQueryBuilder whereHasMorph(string $relation, array|string $types, \Closure $callback = null, string
	 *         $operator = '>=', int $count = 1)
	 * @method static _DatabaseNotificationQueryBuilder whereIn(string $column, $values, string $boolean = 'and', bool $not = false)
	 * @method static _DatabaseNotificationQueryBuilder whereIntegerInRaw(string $column, array|Arrayable $values, string $boolean = 'and', bool $not
	 *         = false)
	 * @method static _DatabaseNotificationQueryBuilder whereIntegerNotInRaw(string $column, array|Arrayable $values, string $boolean = 'and')
	 * @method static _DatabaseNotificationQueryBuilder whereJsonContains(string $column, $value, string $boolean = 'and', bool $not = false)
	 * @method static _DatabaseNotificationQueryBuilder whereJsonDoesntContain(string $column, $value, string $boolean = 'and')
	 * @method static _DatabaseNotificationQueryBuilder whereJsonLength(string $column, $operator, $value = null, string $boolean = 'and')
	 * @method static _DatabaseNotificationQueryBuilder whereKey($id)
	 * @method static _DatabaseNotificationQueryBuilder whereKeyNot($id)
	 * @method static _DatabaseNotificationQueryBuilder whereMonth(string $column, string $operator, \DateTimeInterface|null|string $value = null,
	 *         string $boolean = 'and')
	 * @method static _DatabaseNotificationQueryBuilder whereNested(\Closure $callback, string $boolean = 'and')
	 * @method static _DatabaseNotificationQueryBuilder whereNotBetween(string $column, array $values, string $boolean = 'and')
	 * @method static _DatabaseNotificationQueryBuilder whereNotExists(\Closure $callback, string $boolean = 'and')
	 * @method static _DatabaseNotificationQueryBuilder whereNotIn(string $column, $values, string $boolean = 'and')
	 * @method static _DatabaseNotificationQueryBuilder whereNotNull(string $column, string $boolean = 'and')
	 * @method static _DatabaseNotificationQueryBuilder whereNull(array|string $columns, string $boolean = 'and', bool $not = false)
	 * @method static _DatabaseNotificationQueryBuilder whereRaw(string $sql, $bindings = [], string $boolean = 'and')
	 * @method static _DatabaseNotificationQueryBuilder whereRowValues(array $columns, string $operator, array $values, string $boolean = 'and')
	 * @method static _DatabaseNotificationQueryBuilder whereTime(string $column, string $operator, \DateTimeInterface|null|string $value = null,
	 *         string $boolean = 'and')
	 * @method static _DatabaseNotificationQueryBuilder whereYear(string $column, string $operator, \DateTimeInterface|int|null|string $value = null,
	 *         string $boolean = 'and')
	 * @method static _DatabaseNotificationQueryBuilder with($relations)
	 * @method static _DatabaseNotificationQueryBuilder withCount($relations)
	 * @method static _DatabaseNotificationQueryBuilder withGlobalScope(string $identifier, \Closure|Scope $scope)
	 * @method static _DatabaseNotificationQueryBuilder without($relations)
	 * @method static _DatabaseNotificationQueryBuilder withoutGlobalScope(Scope|string $scope)
	 * @method static _DatabaseNotificationQueryBuilder withoutGlobalScopes(array $scopes = null)
	 */
	class DatabaseNotification extends Model
	{
	}
}

namespace LaravelIdea\Helper
{

	use Illuminate\Contracts\Support\Arrayable;
	use Illuminate\Database\ConnectionInterface;
	use Illuminate\Database\Eloquent\Builder;
	use Illuminate\Database\Query\Expression;
	use Illuminate\Support\Collection;

	/**
	 * @see \Illuminate\Database\Query\Builder::select
	 * @method $this select(array $columns = ['*'])
	 * @see \Illuminate\Database\Query\Builder::paginate
	 * @method $this paginate(int $perPage = 15, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
	 * @see \Illuminate\Database\Query\Builder::addSelect
	 * @method $this addSelect(array $column)
	 * @see \Illuminate\Database\Concerns\BuildsQueries::when
	 * @method $this when($value, callable $callback, callable|null $default = null)
	 * @see \Illuminate\Database\Query\Builder::whereIn
	 * @method $this whereIn(string $column, $values, string $boolean = 'and', bool $not = false)
	 * @see \Illuminate\Database\Query\Builder::orWhereExists
	 * @method $this orWhereExists(\Closure $callback, bool $not = false)
	 * @see \Illuminate\Database\Query\Builder::whereJsonLength
	 * @method $this whereJsonLength(string $column, $operator, $value = null, string $boolean = 'and')
	 * @see \Illuminate\Database\Query\Builder::orWhereNotIn
	 * @method $this orWhereNotIn(string $column, $values)
	 * @see \Illuminate\Database\Query\Builder::selectRaw
	 * @method $this selectRaw(string $expression, array $bindings = [])
	 * @see \Illuminate\Database\Query\Builder::truncate
	 * @method $this truncate()
	 * @see \Illuminate\Database\Query\Builder::lock
	 * @method $this lock(bool|string $value = true)
	 * @see \Illuminate\Database\Query\Builder::insertOrIgnore
	 * @method int insertOrIgnore(array $values)
	 * @see \Illuminate\Database\Query\Builder::join
	 * @method $this join(string $table, \Closure|string $first, null|string $operator = null, null|string $second = null, string $type = 'inner',
	 *         bool $where = false)
	 * @see \Illuminate\Database\Query\Builder::unionAll
	 * @method $this unionAll(\Closure|\Illuminate\Database\Query\Builder $query)
	 * @see \Illuminate\Database\Query\Builder::whereMonth
	 * @method $this whereMonth(string $column, string $operator, \DateTimeInterface|null|string $value = null, string $boolean = 'and')
	 * @see \Illuminate\Database\Query\Builder::having
	 * @method $this having(string $column, null|string $operator = null, null|string $value = null, string $boolean = 'and')
	 * @see \Illuminate\Database\Query\Builder::orWhereNull
	 * @method $this orWhereNull(string $column)
	 * @see \Illuminate\Database\Query\Builder::whereNested
	 * @method $this whereNested(\Closure $callback, string $boolean = 'and')
	 * @see \Illuminate\Database\Query\Builder::joinWhere
	 * @method $this joinWhere(string $table, \Closure|string $first, string $operator, string $second, string $type = 'inner')
	 * @see \Illuminate\Database\Query\Builder::orWhereJsonContains
	 * @method $this orWhereJsonContains(string $column, $value)
	 * @see \Illuminate\Database\Query\Builder::raw
	 * @method Expression raw($value)
	 * @see \Illuminate\Database\Query\Builder::orderBy
	 * @method $this orderBy(\Closure|\Illuminate\Database\Query\Builder|string $column, string $direction = 'asc')
	 * @see \Illuminate\Database\Query\Builder::orWhereRowValues
	 * @method $this orWhereRowValues(array $columns, string $operator, array $values)
	 * @see \Illuminate\Database\Concerns\BuildsQueries::each
	 * @method $this each(callable $callback, int $count = 1000)
	 * @see \Illuminate\Database\Query\Builder::setBindings
	 * @method $this setBindings(array $bindings, string $type = 'where')
	 * @see \Illuminate\Database\Query\Builder::orWhereJsonLength
	 * @method $this orWhereJsonLength(string $column, $operator, $value = null)
	 * @see \Illuminate\Database\Query\Builder::whereRowValues
	 * @method $this whereRowValues(array $columns, string $operator, array $values, string $boolean = 'and')
	 * @see \Illuminate\Database\Query\Builder::useWritePdo
	 * @method $this useWritePdo()
	 * @see \Illuminate\Database\Query\Builder::orWhereNotExists
	 * @method $this orWhereNotExists(\Closure $callback)
	 * @see \Illuminate\Database\Query\Builder::orWhereIn
	 * @method $this orWhereIn(string $column, $values)
	 * @see \Illuminate\Database\Query\Builder::newQuery
	 * @method $this newQuery()
	 * @see \Illuminate\Database\Query\Builder::rightJoinSub
	 * @method $this rightJoinSub(\Closure|\Illuminate\Database\Query\Builder|string $query, string $as, \Closure|string $first, null|string
	 *         $operator = null, null|string $second = null)
	 * @see \Illuminate\Database\Query\Builder::crossJoin
	 * @method $this crossJoin(string $table, \Closure|null|string $first = null, null|string $operator = null, null|string $second = null)
	 * @see \Illuminate\Database\Query\Builder::orderByDesc
	 * @method $this orderByDesc(string $column)
	 * @see \Illuminate\Database\Query\Builder::orWhereNotNull
	 * @method $this orWhereNotNull(string $column)
	 * @see \Illuminate\Database\Query\Builder::average
	 * @method mixed average(string $column)
	 * @see \Illuminate\Database\Query\Builder::getProcessor
	 * @method $this getProcessor()
	 * @see \Illuminate\Database\Query\Builder::increment
	 * @method $this increment(string $column, float|int $amount = 1, array $extra = [])
	 * @see \Illuminate\Database\Query\Builder::havingRaw
	 * @method $this havingRaw(string $sql, array $bindings = [], string $boolean = 'and')
	 * @see \Illuminate\Database\Query\Builder::skip
	 * @method $this skip(int $value)
	 * @see \Illuminate\Database\Query\Builder::sum
	 * @method int sum(string $column)
	 * @see \Illuminate\Database\Query\Builder::leftJoinWhere
	 * @method $this leftJoinWhere(string $table, \Closure|string $first, string $operator, string $second)
	 * @see \Illuminate\Database\Query\Builder::orWhereColumn
	 * @method $this orWhereColumn(array|string $first, null|string $operator = null, null|string $second = null)
	 * @see \Illuminate\Database\Query\Builder::getRawBindings
	 * @method $this getRawBindings()
	 * @see \Illuminate\Database\Query\Builder::min
	 * @method mixed min(string $column)
	 * @see \Illuminate\Support\Traits\Macroable::hasMacro
	 * @method $this hasMacro(string $name)
	 * @see \Illuminate\Database\Query\Builder::whereNotExists
	 * @method $this whereNotExists(\Closure $callback, string $boolean = 'and')
	 * @see \Illuminate\Database\Query\Builder::whereIntegerInRaw
	 * @method $this whereIntegerInRaw(string $column, array|Arrayable $values, string $boolean = 'and', bool $not = false)
	 * @see \Illuminate\Database\Concerns\BuildsQueries::unless
	 * @method $this unless($value, callable $callback, callable|null $default = null)
	 * @see \Illuminate\Database\Query\Builder::whereDay
	 * @method $this whereDay(string $column, string $operator, \DateTimeInterface|null|string $value = null, string $boolean = 'and')
	 * @see \Illuminate\Database\Query\Builder::get
	 * @method $this get(array|string $columns = ['*'])
	 * @see \Illuminate\Database\Query\Builder::whereNotIn
	 * @method $this whereNotIn(string $column, $values, string $boolean = 'and')
	 * @see \Illuminate\Database\Query\Builder::whereTime
	 * @method $this whereTime(string $column, string $operator, \DateTimeInterface|null|string $value = null, string $boolean = 'and')
	 * @see \Illuminate\Database\Query\Builder::where
	 * @method $this where(array|\Closure|string $column, $operator = null, $value = null, string $boolean = 'and')
	 * @see \Illuminate\Database\Query\Builder::latest
	 * @method $this latest(string $column = 'created_at')
	 * @see \Illuminate\Database\Query\Builder::forNestedWhere
	 * @method $this forNestedWhere()
	 * @see \Illuminate\Database\Query\Builder::insertUsing
	 * @method int insertUsing(array $columns, \Closure|\Illuminate\Database\Query\Builder|string $query)
	 * @see \Illuminate\Database\Query\Builder::max
	 * @method mixed max(string $column)
	 * @see \Illuminate\Database\Query\Builder::rightJoinWhere
	 * @method $this rightJoinWhere(string $table, \Closure|string $first, string $operator, string $second)
	 * @see \Illuminate\Database\Query\Builder::whereExists
	 * @method $this whereExists(\Closure $callback, string $boolean = 'and', bool $not = false)
	 * @see \Illuminate\Database\Query\Builder::inRandomOrder
	 * @method $this inRandomOrder(string $seed = '')
	 * @see \Illuminate\Database\Query\Builder::havingBetween
	 * @method $this havingBetween(string $column, array $values, string $boolean = 'and', bool $not = false)
	 * @see \Illuminate\Database\Query\Builder::union
	 * @method $this union(\Closure|\Illuminate\Database\Query\Builder $query, bool $all = false)
	 * @see \Illuminate\Database\Query\Builder::groupBy
	 * @method $this groupBy(array $groups)
	 * @see \Illuminate\Database\Query\Builder::orWhereYear
	 * @method $this orWhereYear(string $column, string $operator, \DateTimeInterface|int|null|string $value = null)
	 * @see \Illuminate\Database\Query\Builder::orWhereDay
	 * @method $this orWhereDay(string $column, string $operator, \DateTimeInterface|null|string $value = null)
	 * @see \Illuminate\Database\Concerns\BuildsQueries::chunkById
	 * @method $this chunkById(int $count, callable $callback, null|string $column = null, null|string $alias = null)
	 * @see \Illuminate\Database\Query\Builder::joinSub
	 * @method $this joinSub(\Closure|\Illuminate\Database\Query\Builder|string $query, string $as, \Closure|string $first, null|string $operator =
	 *         null, null|string $second = null, string $type = 'inner', bool $where = false)
	 * @see \Illuminate\Database\Query\Builder::whereDate
	 * @method $this whereDate(string $column, string $operator, \DateTimeInterface|null|string $value = null, string $boolean = 'and')
	 * @see \Illuminate\Database\Query\Builder::whereJsonDoesntContain
	 * @method $this whereJsonDoesntContain(string $column, $value, string $boolean = 'and')
	 * @see \Illuminate\Database\Query\Builder::oldest
	 * @method $this oldest(string $column = 'created_at')
	 * @see \Illuminate\Database\Query\Builder::decrement
	 * @method $this decrement(string $column, float|int $amount = 1, array $extra = [])
	 * @see \Illuminate\Database\Query\Builder::forPageAfterId
	 * @method $this forPageAfterId(int $perPage = 15, int|null $lastId = 0, string $column = 'id')
	 * @see \Illuminate\Database\Query\Builder::forPage
	 * @method $this forPage(int $page, int $perPage = 15)
	 * @see \Illuminate\Database\Query\Builder::exists
	 * @method bool exists()
	 * @see \Illuminate\Support\Traits\Macroable::macroCall
	 * @method $this macroCall(string $method, array $parameters)
	 * @see \Illuminate\Database\Query\Builder::selectSub
	 * @method $this selectSub(\Closure|\Illuminate\Database\Query\Builder|string $query, string $as)
	 * @see \Illuminate\Database\Query\Builder::pluck
	 * @method $this pluck(string $column, null|string $key = null)
	 * @see \Illuminate\Database\Concerns\BuildsQueries::first
	 * @method $this first(array $columns = ['*'])
	 * @see \Illuminate\Database\Query\Builder::dd
	 * @method void dd()
	 * @see \Illuminate\Database\Query\Builder::whereColumn
	 * @method $this whereColumn(array|string $first, null|string $operator = null, null|string $second = null, null|string $boolean = 'and')
	 * @see \Illuminate\Database\Query\Builder::prepareValueAndOperator
	 * @method $this prepareValueAndOperator(string $value, string $operator, bool $useDefault = false)
	 * @see \Illuminate\Database\Query\Builder::whereNull
	 * @method $this whereNull(array|string $columns, string $boolean = 'and', bool $not = false)
	 * @see \Illuminate\Database\Query\Builder::numericAggregate
	 * @method $this numericAggregate(string $function, array $columns = ['*'])
	 * @see \Illuminate\Database\Query\Builder::whereNotBetween
	 * @method $this whereNotBetween(string $column, array $values, string $boolean = 'and')
	 * @see \Illuminate\Database\Query\Builder::getConnection
	 * @method ConnectionInterface getConnection()
	 * @see \Illuminate\Database\Query\Builder::mergeBindings
	 * @method $this mergeBindings(\Illuminate\Database\Query\Builder $query)
	 * @see \Illuminate\Database\Query\Builder::whereIntegerNotInRaw
	 * @method $this whereIntegerNotInRaw(string $column, array|Arrayable $values, string $boolean = 'and')
	 * @see \Illuminate\Database\Query\Builder::orWhereRaw
	 * @method $this orWhereRaw(string $sql, $bindings = [])
	 * @see \Illuminate\Database\Query\Builder::orWhereJsonDoesntContain
	 * @method $this orWhereJsonDoesntContain(string $column, $value)
	 * @see \Illuminate\Database\Query\Builder::leftJoinSub
	 * @method $this leftJoinSub(\Closure|\Illuminate\Database\Query\Builder|string $query, string $as, \Closure|string $first, null|string $operator
	 *         = null, null|string $second = null)
	 * @see \Illuminate\Database\Query\Builder::find
	 * @method $this find(int|string $id, array $columns = ['*'])
	 * @see \Illuminate\Database\Query\Builder::whereJsonContains
	 * @method $this whereJsonContains(string $column, $value, string $boolean = 'and', bool $not = false)
	 * @see \Illuminate\Database\Query\Builder::limit
	 * @method $this limit(int $value)
	 * @see \Illuminate\Database\Query\Builder::from
	 * @method $this from(\Closure|\Illuminate\Database\Query\Builder|string $table, null|string $as = null)
	 * @see \Illuminate\Database\Query\Builder::insertGetId
	 * @method int insertGetId(array $values, null|string $sequence = null)
	 * @see \Illuminate\Database\Query\Builder::whereBetween
	 * @method $this whereBetween(string $column, array $values, string $boolean = 'and', bool $not = false)
	 * @see \Illuminate\Database\Query\Builder::mergeWheres
	 * @method $this mergeWheres(array $wheres, array $bindings)
	 * @see \Illuminate\Database\Query\Builder::sharedLock
	 * @method $this sharedLock()
	 * @see \Illuminate\Database\Query\Builder::orderByRaw
	 * @method $this orderByRaw(string $sql, array $bindings = [])
	 * @see \Illuminate\Database\Concerns\BuildsQueries::tap
	 * @method $this tap(callable $callback)
	 * @see \Illuminate\Database\Query\Builder::doesntExist
	 * @method bool doesntExist()
	 * @see \Illuminate\Database\Query\Builder::simplePaginate
	 * @method $this simplePaginate(int $perPage = 15, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
	 * @see \Illuminate\Database\Query\Builder::offset
	 * @method $this offset(int $value)
	 * @see \Illuminate\Database\Query\Builder::orWhereMonth
	 * @method $this orWhereMonth(string $column, string $operator, \DateTimeInterface|null|string $value = null)
	 * @see \Illuminate\Database\Query\Builder::whereNotNull
	 * @method $this whereNotNull(string $column, string $boolean = 'and')
	 * @see \Illuminate\Database\Query\Builder::count
	 * @method int count(string $columns = '*')
	 * @see \Illuminate\Database\Query\Builder::orWhereNotBetween
	 * @method $this orWhereNotBetween(string $column, array $values)
	 * @see \Illuminate\Database\Query\Builder::fromRaw
	 * @method $this fromRaw(string $expression, $bindings = [])
	 * @see \Illuminate\Support\Traits\Macroable::mixin
	 * @method $this mixin(object $mixin, bool $replace = true)
	 * @see \Illuminate\Database\Query\Builder::take
	 * @method $this take(int $value)
	 * @see \Illuminate\Database\Query\Builder::updateOrInsert
	 * @method $this updateOrInsert(array $attributes, array $values = [])
	 * @see \Illuminate\Database\Query\Builder::addNestedWhereQuery
	 * @method $this addNestedWhereQuery(\Illuminate\Database\Query\Builder $query, string $boolean = 'and')
	 * @see \Illuminate\Database\Query\Builder::cursor
	 * @method $this cursor()
	 * @see \Illuminate\Database\Query\Builder::cloneWithout
	 * @method $this cloneWithout(array $properties)
	 * @see \Illuminate\Database\Query\Builder::fromSub
	 * @method $this fromSub(\Closure|\Illuminate\Database\Query\Builder|string $query, string $as)
	 * @see \Illuminate\Database\Query\Builder::rightJoin
	 * @method $this rightJoin(string $table, \Closure|string $first, null|string $operator = null, null|string $second = null)
	 * @see \Illuminate\Database\Query\Builder::leftJoin
	 * @method $this leftJoin(string $table, \Closure|string $first, null|string $operator = null, null|string $second = null)
	 * @see \Illuminate\Database\Query\Builder::update
	 * @method $this update(array $values)
	 * @see \Illuminate\Database\Query\Builder::insert
	 * @method bool insert(array $values)
	 * @see \Illuminate\Database\Query\Builder::distinct
	 * @method $this distinct()
	 * @see \Illuminate\Database\Concerns\BuildsQueries::chunk
	 * @method $this chunk(int $count, callable $callback)
	 * @see \Illuminate\Database\Query\Builder::whereYear
	 * @method $this whereYear(string $column, string $operator, \DateTimeInterface|int|null|string $value = null, string $boolean = 'and')
	 * @see \Illuminate\Database\Query\Builder::getCountForPagination
	 * @method $this getCountForPagination(array $columns = ['*'])
	 * @see \Illuminate\Database\Query\Builder::delete
	 * @method $this delete($id = null)
	 * @see \Illuminate\Database\Query\Builder::aggregate
	 * @method $this aggregate(string $function, array $columns = ['*'])
	 * @see \Illuminate\Database\Query\Builder::orWhereDate
	 * @method $this orWhereDate(string $column, string $operator, \DateTimeInterface|null|string $value = null)
	 * @see \Illuminate\Database\Query\Builder::avg
	 * @method mixed avg(string $column)
	 * @see \Illuminate\Database\Query\Builder::addBinding
	 * @method $this addBinding($value, string $type = 'where')
	 * @see \Illuminate\Database\Query\Builder::getGrammar
	 * @method $this getGrammar()
	 * @see \Illuminate\Database\Query\Builder::lockForUpdate
	 * @method $this lockForUpdate()
	 * @see \Illuminate\Database\Concerns\BuildsQueries::eachById
	 * @method $this eachById(callable $callback, int $count = 1000, string $column = null, string $alias = null)
	 * @see \Illuminate\Database\Query\Builder::implode
	 * @method $this implode(string $column, string $glue = '')
	 * @see \Illuminate\Database\Query\Builder::dump
	 * @method void dump()
	 * @see \Illuminate\Database\Query\Builder::value
	 * @method $this value(string $column)
	 * @see \Illuminate\Database\Query\Builder::cloneWithoutBindings
	 * @method $this cloneWithoutBindings(array $except)
	 * @see \Illuminate\Database\Query\Builder::addWhereExistsQuery
	 * @method $this addWhereExistsQuery(\Illuminate\Database\Query\Builder $query, string $boolean = 'and', bool $not = false)
	 * @see \Illuminate\Support\Traits\Macroable::macro
	 * @method $this macro(string $name, callable|object $macro)
	 * @see \Illuminate\Database\Query\Builder::whereRaw
	 * @method $this whereRaw(string $sql, $bindings = [], string $boolean = 'and')
	 * @see \Illuminate\Database\Query\Builder::toSql
	 * @method string toSql()
	 * @see \Illuminate\Database\Query\Builder::orHaving
	 * @method $this orHaving(string $column, null|string $operator = null, null|string $value = null)
	 * @see \Illuminate\Database\Query\Builder::orHavingRaw
	 * @method $this orHavingRaw(string $sql, array $bindings = [])
	 * @see \Illuminate\Database\Query\Builder::getBindings
	 * @method array getBindings()
	 * @see \Illuminate\Database\Query\Builder::forPageBeforeId
	 * @method $this forPageBeforeId(int $perPage = 15, int|null $lastId = 0, string $column = 'id')
	 * @see \Illuminate\Database\Query\Builder::orWhereTime
	 * @method $this orWhereTime(string $column, string $operator, \DateTimeInterface|null|string $value = null)
	 * @see \Illuminate\Database\Query\Builder::orWhereBetween
	 * @method $this orWhereBetween(string $column, array $values)
	 * @see \Illuminate\Database\Query\Builder::orWhere
	 * @method $this orWhere(array|\Closure|string $column, $operator = null, $value = null)
	 * @see \Illuminate\Database\Query\Builder::dynamicWhere
	 * @method $this dynamicWhere(string $method, array $parameters)
	 */
	class _BaseBuilder extends Builder
	{
	}

	/**
	 * @method Collection mapSpread(callable $callback)
	 * @method Collection mapWithKeys(callable $callback)
	 * @method Collection zip(array $items)
	 * @method Collection partition(callable|string $key, $operator = null, $value = null)
	 * @method Collection mapInto(string $class)
	 * @method Collection mapToGroups(callable $callback)
	 * @method Collection map(callable $callback)
	 * @method Collection groupBy(array|callable|string $groupBy, bool $preserveKeys = false)
	 * @method Collection pluck(array|string $value, null|string $key = null)
	 * @method Collection pad(int $size, $value)
	 * @method Collection split(int $numberOfGroups)
	 * @method Collection combine($values)
	 * @method Collection countBy(callable|null $callback = null)
	 * @method Collection mapToDictionary(callable $callback)
	 * @method Collection keys()
	 * @method Collection transform(callable $callback)
	 * @method Collection flatMap(callable $callback)
	 * @method Collection collapse()
	 */
	class _BaseCollection extends Collection
	{
	}
}

namespace LaravelIdea\Helper\App
{

	use App\File;
	use App\FileFavourite;
	use App\FileView;
	use App\User;
	use Illuminate\Contracts\Support\Arrayable;
	use Illuminate\Notifications\Notification;
	use Laravel\Passport\Token;
	use LaravelIdea\Helper\_BaseBuilder;
	use LaravelIdea\Helper\_BaseCollection;

	/**
	 * @method File shift()
	 * @method File pop()
	 * @method File get($key, $default = null)
	 * @method File pull($key, $default = null)
	 * @method File first(callable $callback = null, $default = null)
	 * @method File firstWhere(string $key, $operator = null, $value = null)
	 * @method File[] all()
	 * @method File last(callable $callback = null, $default = null)
	 * @property-read _FileCollectionProxy $keyBy
	 * @property-read _FileCollectionProxy $max
	 * @property-read _FileCollectionProxy $partition
	 * @property-read _FileCollectionProxy $average
	 * @property-read _FileCollectionProxy $flatMap
	 * @property-read _FileCollectionProxy $each
	 * @property-read _FileCollectionProxy $map
	 * @property-read _FileCollectionProxy $sortByDesc
	 * @property-read _FileCollectionProxy $filter
	 * @property-read _FileCollectionProxy $avg
	 * @property-read _FileCollectionProxy $unique
	 * @property-read _FileCollectionProxy $first
	 * @property-read _FileCollectionProxy $min
	 * @property-read _FileCollectionProxy $groupBy
	 * @property-read _FileCollectionProxy $reject
	 * @property-read _FileCollectionProxy $sortBy
	 * @property-read _FileCollectionProxy $contains
	 * @property-read _FileCollectionProxy $sum
	 * @property-read _FileCollectionProxy $every
	 */
	class _FileCollection extends _BaseCollection
	{
		/**
		 * @param int $size
		 *
		 * @return File[][]
		 */
		public function chunk($size)
		{
			return [];
		}
	}

	/**
	 * @property _FileCollection|mixed $id
	 * @property _FileCollection|mixed $user_id
	 * @property _FileCollection|mixed $name
	 * @property _FileCollection|mixed $description
	 * @property _FileCollection|mixed $type
	 * @property _FileCollection|mixed $mime_type
	 * @property _FileCollection|mixed $extension
	 * @property _FileCollection|mixed $hd
	 * @property _FileCollection|mixed $sd
	 * @property _FileCollection|mixed $thumb
	 * @property _FileCollection|mixed $thumb_hd
	 * @property _FileCollection|mixed $size_in_bytes
	 * @property _FileCollection|mixed $embed
	 * @property _FileCollection|mixed $meta
	 * @property _FileCollection|mixed $private
	 * @property _FileCollection|mixed $status
	 * @property _FileCollection|mixed $created_at
	 * @property _FileCollection|mixed $updated_at
	 * @property _FileCollection|mixed $user
	 * @see \App\File::formatSizeUnits
	 * @method _FileCollection formatSizeUnits()
	 * @see \App\File::file
	 * @method _FileCollection file($file)
	 * @see \App\File::codeFileContents
	 * @method _FileCollection codeFileContents()
	 * @see \App\Traits\Favourable::favourite
	 * @method _FileCollection favourite()
	 * @see \App\Traits\Favourable::hasFavourited
	 * @method _FileCollection hasFavourited()
	 * @see \App\Traits\Viewable::saveView
	 * @method _FileCollection saveView()
	 * @see \Illuminate\Database\Eloquent\Model::update
	 * @method _FileCollection update(array $attributes = [], array $options = [])
	 * @see \Illuminate\Database\Eloquent\Model::save
	 * @method _FileCollection save(array $options = [])
	 * @see \Illuminate\Database\Eloquent\Model::increment
	 * @method _FileCollection increment(string $column, float|int $amount = 1, array $extra = [])
	 * @see \Illuminate\Database\Eloquent\Model::decrement
	 * @method _FileCollection decrement(string $column, float|int $amount = 1, array $extra = [])
	 * @see \Illuminate\Database\Eloquent\Concerns\HasTimestamps::touch
	 * @method _FileCollection touch()
	 * @see \Illuminate\Database\Eloquent\Model::fill
	 * @method _FileCollection fill(array $attributes)
	 * @see \Illuminate\Database\Eloquent\Model::delete
	 * @method _FileCollection delete()
	 */
	class _FileCollectionProxy
	{
	}

	/**
	 * @method FileFavourite shift()
	 * @method FileFavourite pop()
	 * @method FileFavourite get($key, $default = null)
	 * @method FileFavourite pull($key, $default = null)
	 * @method FileFavourite first(callable $callback = null, $default = null)
	 * @method FileFavourite firstWhere(string $key, $operator = null, $value = null)
	 * @method FileFavourite[] all()
	 * @method FileFavourite last(callable $callback = null, $default = null)
	 * @property-read _FileFavouriteCollectionProxy $keyBy
	 * @property-read _FileFavouriteCollectionProxy $max
	 * @property-read _FileFavouriteCollectionProxy $partition
	 * @property-read _FileFavouriteCollectionProxy $average
	 * @property-read _FileFavouriteCollectionProxy $flatMap
	 * @property-read _FileFavouriteCollectionProxy $each
	 * @property-read _FileFavouriteCollectionProxy $map
	 * @property-read _FileFavouriteCollectionProxy $sortByDesc
	 * @property-read _FileFavouriteCollectionProxy $filter
	 * @property-read _FileFavouriteCollectionProxy $avg
	 * @property-read _FileFavouriteCollectionProxy $unique
	 * @property-read _FileFavouriteCollectionProxy $first
	 * @property-read _FileFavouriteCollectionProxy $min
	 * @property-read _FileFavouriteCollectionProxy $groupBy
	 * @property-read _FileFavouriteCollectionProxy $reject
	 * @property-read _FileFavouriteCollectionProxy $sortBy
	 * @property-read _FileFavouriteCollectionProxy $contains
	 * @property-read _FileFavouriteCollectionProxy $sum
	 * @property-read _FileFavouriteCollectionProxy $every
	 */
	class _FileFavouriteCollection extends _BaseCollection
	{
		/**
		 * @param int $size
		 *
		 * @return FileFavourite[][]
		 */
		public function chunk($size)
		{
			return [];
		}
	}

	/**
	 * @property _FileFavouriteCollection|mixed $id
	 * @property _FileFavouriteCollection|mixed $file_id
	 * @property _FileFavouriteCollection|mixed $user_id
	 * @property _FileFavouriteCollection|mixed $created_at
	 * @property _FileFavouriteCollection|mixed $updated_at
	 * @see \Illuminate\Database\Eloquent\Model::update
	 * @method _FileFavouriteCollection update(array $attributes = [], array $options = [])
	 * @see \Illuminate\Database\Eloquent\Model::save
	 * @method _FileFavouriteCollection save(array $options = [])
	 * @see \Illuminate\Database\Eloquent\Model::increment
	 * @method _FileFavouriteCollection increment(string $column, float|int $amount = 1, array $extra = [])
	 * @see \Illuminate\Database\Eloquent\Model::decrement
	 * @method _FileFavouriteCollection decrement(string $column, float|int $amount = 1, array $extra = [])
	 * @see \Illuminate\Database\Eloquent\Concerns\HasTimestamps::touch
	 * @method _FileFavouriteCollection touch()
	 * @see \Illuminate\Database\Eloquent\Model::fill
	 * @method _FileFavouriteCollection fill(array $attributes)
	 * @see \Illuminate\Database\Eloquent\Model::delete
	 * @method _FileFavouriteCollection delete()
	 */
	class _FileFavouriteCollectionProxy
	{
	}

	/**
	 * @method _FileFavouriteQueryBuilder whereId($value)
	 * @method _FileFavouriteQueryBuilder whereFileId($value)
	 * @method _FileFavouriteQueryBuilder whereUserId($value)
	 * @method _FileFavouriteQueryBuilder whereCreatedAt($value)
	 * @method _FileFavouriteQueryBuilder whereUpdatedAt($value)
	 * @method FileFavourite create(array $attributes = [])
	 * @method _FileFavouriteCollection|FileFavourite[] cursor()
	 * @method FileFavourite|null find($id, array $columns = ['*'])
	 * @method _FileFavouriteCollection|FileFavourite[] findMany(array|Arrayable $ids, array $columns = ['*'])
	 * @method FileFavourite findOrFail($id, array $columns = ['*'])
	 * @method _FileFavouriteCollection|FileFavourite[] findOrNew($id, array $columns = ['*'])
	 * @method FileFavourite first(array $columns = ['*'])
	 * @method FileFavourite firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
	 * @method FileFavourite firstOrCreate(array $attributes, array $values = [])
	 * @method FileFavourite firstOrFail(array $columns = ['*'])
	 * @method FileFavourite firstOrNew(array $attributes, array $values = [])
	 * @method FileFavourite forceCreate(array $attributes)
	 * @method _FileFavouriteCollection|FileFavourite[] fromQuery(string $query, array $bindings = [])
	 * @method _FileFavouriteCollection|FileFavourite[] get(array $columns = ['*'])
	 * @method FileFavourite getModel()
	 * @method FileFavourite[] getModels(array $columns = ['*'])
	 * @method _FileFavouriteCollection|FileFavourite[] hydrate(array $items)
	 * @method FileFavourite make(array $attributes = [])
	 * @method FileFavourite newModelInstance(array $attributes = [])
	 * @method FileFavourite updateOrCreate(array $attributes, array $values = [])
	 */
	class _FileFavouriteQueryBuilder extends _BaseBuilder
	{
	}

	/**
	 * @method _FileQueryBuilder whereId($value)
	 * @method _FileQueryBuilder whereUserId($value)
	 * @method _FileQueryBuilder whereName($value)
	 * @method _FileQueryBuilder whereDescription($value)
	 * @method _FileQueryBuilder whereType($value)
	 * @method _FileQueryBuilder whereMimeType($value)
	 * @method _FileQueryBuilder whereExtension($value)
	 * @method _FileQueryBuilder whereHd($value)
	 * @method _FileQueryBuilder whereSd($value)
	 * @method _FileQueryBuilder whereThumb($value)
	 * @method _FileQueryBuilder whereThumbHd($value)
	 * @method _FileQueryBuilder whereSizeInBytes($value)
	 * @method _FileQueryBuilder whereEmbed($value)
	 * @method _FileQueryBuilder whereMeta($value)
	 * @method _FileQueryBuilder wherePrivate($value)
	 * @method _FileQueryBuilder whereStatus($value)
	 * @method _FileQueryBuilder whereCreatedAt($value)
	 * @method _FileQueryBuilder whereUpdatedAt($value)
	 * @method File create(array $attributes = [])
	 * @method _FileCollection|File[] cursor()
	 * @method File|null find($id, array $columns = ['*'])
	 * @method _FileCollection|File[] findMany(array|Arrayable $ids, array $columns = ['*'])
	 * @method File findOrFail($id, array $columns = ['*'])
	 * @method _FileCollection|File[] findOrNew($id, array $columns = ['*'])
	 * @method File first(array $columns = ['*'])
	 * @method File firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
	 * @method File firstOrCreate(array $attributes, array $values = [])
	 * @method File firstOrFail(array $columns = ['*'])
	 * @method File firstOrNew(array $attributes, array $values = [])
	 * @method File forceCreate(array $attributes)
	 * @method _FileCollection|File[] fromQuery(string $query, array $bindings = [])
	 * @method _FileCollection|File[] get(array $columns = ['*'])
	 * @method File getModel()
	 * @method File[] getModels(array $columns = ['*'])
	 * @method _FileCollection|File[] hydrate(array $items)
	 * @method File make(array $attributes = [])
	 * @method File newModelInstance(array $attributes = [])
	 * @method File updateOrCreate(array $attributes, array $values = [])
	 */
	class _FileQueryBuilder extends _BaseBuilder
	{
	}

	/**
	 * @method FileView shift()
	 * @method FileView pop()
	 * @method FileView get($key, $default = null)
	 * @method FileView pull($key, $default = null)
	 * @method FileView first(callable $callback = null, $default = null)
	 * @method FileView firstWhere(string $key, $operator = null, $value = null)
	 * @method FileView[] all()
	 * @method FileView last(callable $callback = null, $default = null)
	 * @property-read _FileViewCollectionProxy $keyBy
	 * @property-read _FileViewCollectionProxy $max
	 * @property-read _FileViewCollectionProxy $partition
	 * @property-read _FileViewCollectionProxy $average
	 * @property-read _FileViewCollectionProxy $flatMap
	 * @property-read _FileViewCollectionProxy $each
	 * @property-read _FileViewCollectionProxy $map
	 * @property-read _FileViewCollectionProxy $sortByDesc
	 * @property-read _FileViewCollectionProxy $filter
	 * @property-read _FileViewCollectionProxy $avg
	 * @property-read _FileViewCollectionProxy $unique
	 * @property-read _FileViewCollectionProxy $first
	 * @property-read _FileViewCollectionProxy $min
	 * @property-read _FileViewCollectionProxy $groupBy
	 * @property-read _FileViewCollectionProxy $reject
	 * @property-read _FileViewCollectionProxy $sortBy
	 * @property-read _FileViewCollectionProxy $contains
	 * @property-read _FileViewCollectionProxy $sum
	 * @property-read _FileViewCollectionProxy $every
	 */
	class _FileViewCollection extends _BaseCollection
	{
		/**
		 * @param int $size
		 *
		 * @return FileView[][]
		 */
		public function chunk($size)
		{
			return [];
		}
	}

	/**
	 * @property _FileViewCollection|mixed $id
	 * @property _FileViewCollection|mixed $file_id
	 * @property _FileViewCollection|mixed $ip
	 * @property _FileViewCollection|mixed $created_at
	 * @property _FileViewCollection|mixed $updated_at
	 * @property _FileViewCollection|mixed $file
	 * @see \Illuminate\Database\Eloquent\Model::update
	 * @method _FileViewCollection update(array $attributes = [], array $options = [])
	 * @see \Illuminate\Database\Eloquent\Model::save
	 * @method _FileViewCollection save(array $options = [])
	 * @see \Illuminate\Database\Eloquent\Model::increment
	 * @method _FileViewCollection increment(string $column, float|int $amount = 1, array $extra = [])
	 * @see \Illuminate\Database\Eloquent\Model::decrement
	 * @method _FileViewCollection decrement(string $column, float|int $amount = 1, array $extra = [])
	 * @see \Illuminate\Database\Eloquent\Concerns\HasTimestamps::touch
	 * @method _FileViewCollection touch()
	 * @see \Illuminate\Database\Eloquent\Model::fill
	 * @method _FileViewCollection fill(array $attributes)
	 * @see \Illuminate\Database\Eloquent\Model::delete
	 * @method _FileViewCollection delete()
	 */
	class _FileViewCollectionProxy
	{
	}

	/**
	 * @method _FileViewQueryBuilder whereId($value)
	 * @method _FileViewQueryBuilder whereFileId($value)
	 * @method _FileViewQueryBuilder whereIp($value)
	 * @method _FileViewQueryBuilder whereCreatedAt($value)
	 * @method _FileViewQueryBuilder whereUpdatedAt($value)
	 * @method FileView create(array $attributes = [])
	 * @method _FileViewCollection|FileView[] cursor()
	 * @method FileView|null find($id, array $columns = ['*'])
	 * @method _FileViewCollection|FileView[] findMany(array|Arrayable $ids, array $columns = ['*'])
	 * @method FileView findOrFail($id, array $columns = ['*'])
	 * @method _FileViewCollection|FileView[] findOrNew($id, array $columns = ['*'])
	 * @method FileView first(array $columns = ['*'])
	 * @method FileView firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
	 * @method FileView firstOrCreate(array $attributes, array $values = [])
	 * @method FileView firstOrFail(array $columns = ['*'])
	 * @method FileView firstOrNew(array $attributes, array $values = [])
	 * @method FileView forceCreate(array $attributes)
	 * @method _FileViewCollection|FileView[] fromQuery(string $query, array $bindings = [])
	 * @method _FileViewCollection|FileView[] get(array $columns = ['*'])
	 * @method FileView getModel()
	 * @method FileView[] getModels(array $columns = ['*'])
	 * @method _FileViewCollection|FileView[] hydrate(array $items)
	 * @method FileView make(array $attributes = [])
	 * @method FileView newModelInstance(array $attributes = [])
	 * @method FileView updateOrCreate(array $attributes, array $values = [])
	 */
	class _FileViewQueryBuilder extends _BaseBuilder
	{
	}

	/**
	 * @method User shift()
	 * @method User pop()
	 * @method User get($key, $default = null)
	 * @method User pull($key, $default = null)
	 * @method User first(callable $callback = null, $default = null)
	 * @method User firstWhere(string $key, $operator = null, $value = null)
	 * @method User[] all()
	 * @method User last(callable $callback = null, $default = null)
	 * @property-read _UserCollectionProxy $keyBy
	 * @property-read _UserCollectionProxy $max
	 * @property-read _UserCollectionProxy $partition
	 * @property-read _UserCollectionProxy $average
	 * @property-read _UserCollectionProxy $flatMap
	 * @property-read _UserCollectionProxy $each
	 * @property-read _UserCollectionProxy $map
	 * @property-read _UserCollectionProxy $sortByDesc
	 * @property-read _UserCollectionProxy $filter
	 * @property-read _UserCollectionProxy $avg
	 * @property-read _UserCollectionProxy $unique
	 * @property-read _UserCollectionProxy $first
	 * @property-read _UserCollectionProxy $min
	 * @property-read _UserCollectionProxy $groupBy
	 * @property-read _UserCollectionProxy $reject
	 * @property-read _UserCollectionProxy $sortBy
	 * @property-read _UserCollectionProxy $contains
	 * @property-read _UserCollectionProxy $sum
	 * @property-read _UserCollectionProxy $every
	 */
	class _UserCollection extends _BaseCollection
	{
		/**
		 * @param int $size
		 *
		 * @return User[][]
		 */
		public function chunk($size)
		{
			return [];
		}
	}

	/**
	 * @property _UserCollection|mixed $id
	 * @property _UserCollection|mixed $name
	 * @property _UserCollection|mixed $email
	 * @property _UserCollection|mixed $email_verified_at
	 * @property _UserCollection|mixed $password
	 * @property _UserCollection|mixed $private_uploads
	 * @property _UserCollection|mixed $remember_token
	 * @property _UserCollection|mixed $created_at
	 * @property _UserCollection|mixed $updated_at
	 * @property _UserCollection|mixed $webhook_url
	 * @property _UserCollection|mixed $webhook_key
	 * @property _UserCollection|mixed $low_def_only
	 * @see \Illuminate\Notifications\RoutesNotifications::routeNotificationFor
	 * @method _UserCollection routeNotificationFor(string $driver, Notification|null $notification = null)
	 * @see \Illuminate\Notifications\RoutesNotifications::notifyNow
	 * @method _UserCollection notifyNow($instance, array $channels = null)
	 * @see \Illuminate\Notifications\RoutesNotifications::notify
	 * @method _UserCollection notify($instance)
	 * @see \Illuminate\Notifications\HasDatabaseNotifications::unreadNotifications
	 * @method _UserCollection unreadNotifications()
	 * @see \Illuminate\Notifications\HasDatabaseNotifications::readNotifications
	 * @method _UserCollection readNotifications()
	 * @see \Laravel\Passport\HasApiTokens::clients
	 * @method _UserCollection clients()
	 * @see \Laravel\Passport\HasApiTokens::token
	 * @method _UserCollection token()
	 * @see \Laravel\Passport\HasApiTokens::tokens
	 * @method _UserCollection tokens()
	 * @see \Laravel\Passport\HasApiTokens::withAccessToken
	 * @method _UserCollection withAccessToken(Token $accessToken)
	 * @see \Laravel\Passport\HasApiTokens::createToken
	 * @method _UserCollection createToken(string $name, array $scopes = [])
	 * @see \Laravel\Passport\HasApiTokens::tokenCan
	 * @method _UserCollection tokenCan(string $scope)
	 * @see \Illuminate\Auth\MustVerifyEmail::hasVerifiedEmail
	 * @method _UserCollection hasVerifiedEmail()
	 * @see \Illuminate\Auth\MustVerifyEmail::getEmailForVerification
	 * @method _UserCollection getEmailForVerification()
	 * @see \Illuminate\Auth\MustVerifyEmail::sendEmailVerificationNotification
	 * @method _UserCollection sendEmailVerificationNotification()
	 * @see \Illuminate\Auth\MustVerifyEmail::markEmailAsVerified
	 * @method _UserCollection markEmailAsVerified()
	 * @see \Illuminate\Auth\Authenticatable::setRememberToken
	 * @method _UserCollection setRememberToken(string $value)
	 * @see \Illuminate\Auth\Authenticatable::getRememberTokenName
	 * @method _UserCollection getRememberTokenName()
	 * @see \Illuminate\Auth\Authenticatable::getAuthIdentifierName
	 * @method _UserCollection getAuthIdentifierName()
	 * @see \Illuminate\Auth\Authenticatable::getAuthPassword
	 * @method _UserCollection getAuthPassword()
	 * @see \Illuminate\Auth\Authenticatable::getRememberToken
	 * @method _UserCollection getRememberToken()
	 * @see \Illuminate\Auth\Authenticatable::getAuthIdentifier
	 * @method _UserCollection getAuthIdentifier()
	 * @see \Illuminate\Foundation\Auth\Access\Authorizable::cannot
	 * @method _UserCollection cannot(string $ability, array $arguments = [])
	 * @see \Illuminate\Foundation\Auth\Access\Authorizable::can
	 * @method _UserCollection can(string $ability, array $arguments = [])
	 * @see \Illuminate\Foundation\Auth\Access\Authorizable::cant
	 * @method _UserCollection cant(string $ability, array $arguments = [])
	 * @see \Illuminate\Auth\Passwords\CanResetPassword::getEmailForPasswordReset
	 * @method _UserCollection getEmailForPasswordReset()
	 * @see \Illuminate\Auth\Passwords\CanResetPassword::sendPasswordResetNotification
	 * @method _UserCollection sendPasswordResetNotification(string $token)
	 * @see \Illuminate\Database\Eloquent\Model::update
	 * @method _UserCollection update(array $attributes = [], array $options = [])
	 * @see \Illuminate\Database\Eloquent\Model::save
	 * @method _UserCollection save(array $options = [])
	 * @see \Illuminate\Database\Eloquent\Model::increment
	 * @method _UserCollection increment(string $column, float|int $amount = 1, array $extra = [])
	 * @see \Illuminate\Database\Eloquent\Model::decrement
	 * @method _UserCollection decrement(string $column, float|int $amount = 1, array $extra = [])
	 * @see \Illuminate\Database\Eloquent\Concerns\HasTimestamps::touch
	 * @method _UserCollection touch()
	 * @see \Illuminate\Database\Eloquent\Model::fill
	 * @method _UserCollection fill(array $attributes)
	 * @see \Illuminate\Database\Eloquent\Model::delete
	 * @method _UserCollection delete()
	 */
	class _UserCollectionProxy
	{
	}

	/**
	 * @method _UserQueryBuilder whereId($value)
	 * @method _UserQueryBuilder whereName($value)
	 * @method _UserQueryBuilder whereEmail($value)
	 * @method _UserQueryBuilder whereEmailVerifiedAt($value)
	 * @method _UserQueryBuilder wherePassword($value)
	 * @method _UserQueryBuilder wherePrivateUploads($value)
	 * @method _UserQueryBuilder whereRememberToken($value)
	 * @method _UserQueryBuilder whereCreatedAt($value)
	 * @method _UserQueryBuilder whereUpdatedAt($value)
	 * @method _UserQueryBuilder whereWebhookUrl($value)
	 * @method _UserQueryBuilder whereWebhookKey($value)
	 * @method _UserQueryBuilder whereLowDefOnly($value)
	 * @method User create(array $attributes = [])
	 * @method _UserCollection|User[] cursor()
	 * @method User|null find($id, array $columns = ['*'])
	 * @method _UserCollection|User[] findMany(array|Arrayable $ids, array $columns = ['*'])
	 * @method User findOrFail($id, array $columns = ['*'])
	 * @method _UserCollection|User[] findOrNew($id, array $columns = ['*'])
	 * @method User first(array $columns = ['*'])
	 * @method User firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
	 * @method User firstOrCreate(array $attributes, array $values = [])
	 * @method User firstOrFail(array $columns = ['*'])
	 * @method User firstOrNew(array $attributes, array $values = [])
	 * @method User forceCreate(array $attributes)
	 * @method _UserCollection|User[] fromQuery(string $query, array $bindings = [])
	 * @method _UserCollection|User[] get(array $columns = ['*'])
	 * @method User getModel()
	 * @method User[] getModels(array $columns = ['*'])
	 * @method _UserCollection|User[] hydrate(array $items)
	 * @method User make(array $attributes = [])
	 * @method User newModelInstance(array $attributes = [])
	 * @method User updateOrCreate(array $attributes, array $values = [])
	 */
	class _UserQueryBuilder extends _BaseBuilder
	{
	}
}

namespace LaravelIdea\Helper\Illuminate\Notifications
{

	use Illuminate\Contracts\Support\Arrayable;
	use Illuminate\Notifications\DatabaseNotification;
	use LaravelIdea\Helper\_BaseBuilder;
	use LaravelIdea\Helper\_BaseCollection;

	/**
	 * @method DatabaseNotification shift()
	 * @method DatabaseNotification pop()
	 * @method DatabaseNotification get($key, $default = null)
	 * @method DatabaseNotification pull($key, $default = null)
	 * @method DatabaseNotification first(callable $callback = null, $default = null)
	 * @method DatabaseNotification firstWhere(string $key, $operator = null, $value = null)
	 * @method DatabaseNotification[] all()
	 * @method DatabaseNotification last(callable $callback = null, $default = null)
	 * @property-read _DatabaseNotificationCollectionProxy $keyBy
	 * @property-read _DatabaseNotificationCollectionProxy $max
	 * @property-read _DatabaseNotificationCollectionProxy $partition
	 * @property-read _DatabaseNotificationCollectionProxy $average
	 * @property-read _DatabaseNotificationCollectionProxy $flatMap
	 * @property-read _DatabaseNotificationCollectionProxy $each
	 * @property-read _DatabaseNotificationCollectionProxy $map
	 * @property-read _DatabaseNotificationCollectionProxy $sortByDesc
	 * @property-read _DatabaseNotificationCollectionProxy $filter
	 * @property-read _DatabaseNotificationCollectionProxy $avg
	 * @property-read _DatabaseNotificationCollectionProxy $unique
	 * @property-read _DatabaseNotificationCollectionProxy $first
	 * @property-read _DatabaseNotificationCollectionProxy $min
	 * @property-read _DatabaseNotificationCollectionProxy $groupBy
	 * @property-read _DatabaseNotificationCollectionProxy $reject
	 * @property-read _DatabaseNotificationCollectionProxy $sortBy
	 * @property-read _DatabaseNotificationCollectionProxy $contains
	 * @property-read _DatabaseNotificationCollectionProxy $sum
	 * @property-read _DatabaseNotificationCollectionProxy $every
	 */
	class _DatabaseNotificationCollection extends _BaseCollection
	{
		/**
		 * @param int $size
		 *
		 * @return DatabaseNotification[][]
		 */
		public function chunk($size)
		{
			return [];
		}
	}

	/**
	 * @see \Illuminate\Database\Eloquent\Model::update
	 * @method _DatabaseNotificationCollection update(array $attributes = [], array $options = [])
	 * @see \Illuminate\Database\Eloquent\Model::save
	 * @method _DatabaseNotificationCollection save(array $options = [])
	 * @see \Illuminate\Database\Eloquent\Model::increment
	 * @method _DatabaseNotificationCollection increment(string $column, float|int $amount = 1, array $extra = [])
	 * @see \Illuminate\Database\Eloquent\Model::decrement
	 * @method _DatabaseNotificationCollection decrement(string $column, float|int $amount = 1, array $extra = [])
	 * @see \Illuminate\Database\Eloquent\Concerns\HasTimestamps::touch
	 * @method _DatabaseNotificationCollection touch()
	 * @see \Illuminate\Database\Eloquent\Model::fill
	 * @method _DatabaseNotificationCollection fill(array $attributes)
	 * @see \Illuminate\Database\Eloquent\Model::delete
	 * @method _DatabaseNotificationCollection delete()
	 */
	class _DatabaseNotificationCollectionProxy
	{
	}

	/**
	 * @method DatabaseNotification create(array $attributes = [])
	 * @method _DatabaseNotificationCollection|DatabaseNotification[] cursor()
	 * @method DatabaseNotification|null find($id, array $columns = ['*'])
	 * @method _DatabaseNotificationCollection|DatabaseNotification[] findMany(array|Arrayable $ids, array $columns = ['*'])
	 * @method DatabaseNotification findOrFail($id, array $columns = ['*'])
	 * @method _DatabaseNotificationCollection|DatabaseNotification[] findOrNew($id, array $columns = ['*'])
	 * @method DatabaseNotification first(array $columns = ['*'])
	 * @method DatabaseNotification firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
	 * @method DatabaseNotification firstOrCreate(array $attributes, array $values = [])
	 * @method DatabaseNotification firstOrFail(array $columns = ['*'])
	 * @method DatabaseNotification firstOrNew(array $attributes, array $values = [])
	 * @method DatabaseNotification forceCreate(array $attributes)
	 * @method _DatabaseNotificationCollection|DatabaseNotification[] fromQuery(string $query, array $bindings = [])
	 * @method _DatabaseNotificationCollection|DatabaseNotification[] get(array $columns = ['*'])
	 * @method DatabaseNotification getModel()
	 * @method DatabaseNotification[] getModels(array $columns = ['*'])
	 * @method _DatabaseNotificationCollection|DatabaseNotification[] hydrate(array $items)
	 * @method DatabaseNotification make(array $attributes = [])
	 * @method DatabaseNotification newModelInstance(array $attributes = [])
	 * @method DatabaseNotification updateOrCreate(array $attributes, array $values = [])
	 */
	class _DatabaseNotificationQueryBuilder extends _BaseBuilder
	{
	}
}

namespace LaravelIdea\Helper\Laravel\Passport
{

	use Illuminate\Contracts\Support\Arrayable;
	use Laravel\Passport\AuthCode;
	use Laravel\Passport\Client;
	use Laravel\Passport\PersonalAccessClient;
	use Laravel\Passport\Token;
	use LaravelIdea\Helper\_BaseBuilder;
	use LaravelIdea\Helper\_BaseCollection;

	/**
	 * @method AuthCode shift()
	 * @method AuthCode pop()
	 * @method AuthCode get($key, $default = null)
	 * @method AuthCode pull($key, $default = null)
	 * @method AuthCode first(callable $callback = null, $default = null)
	 * @method AuthCode firstWhere(string $key, $operator = null, $value = null)
	 * @method AuthCode[] all()
	 * @method AuthCode last(callable $callback = null, $default = null)
	 * @property-read _AuthCodeCollectionProxy $keyBy
	 * @property-read _AuthCodeCollectionProxy $max
	 * @property-read _AuthCodeCollectionProxy $partition
	 * @property-read _AuthCodeCollectionProxy $average
	 * @property-read _AuthCodeCollectionProxy $flatMap
	 * @property-read _AuthCodeCollectionProxy $each
	 * @property-read _AuthCodeCollectionProxy $map
	 * @property-read _AuthCodeCollectionProxy $sortByDesc
	 * @property-read _AuthCodeCollectionProxy $filter
	 * @property-read _AuthCodeCollectionProxy $avg
	 * @property-read _AuthCodeCollectionProxy $unique
	 * @property-read _AuthCodeCollectionProxy $first
	 * @property-read _AuthCodeCollectionProxy $min
	 * @property-read _AuthCodeCollectionProxy $groupBy
	 * @property-read _AuthCodeCollectionProxy $reject
	 * @property-read _AuthCodeCollectionProxy $sortBy
	 * @property-read _AuthCodeCollectionProxy $contains
	 * @property-read _AuthCodeCollectionProxy $sum
	 * @property-read _AuthCodeCollectionProxy $every
	 */
	class _AuthCodeCollection extends _BaseCollection
	{
		/**
		 * @param int $size
		 *
		 * @return AuthCode[][]
		 */
		public function chunk($size)
		{
			return [];
		}
	}

	/**
	 * @property _AuthCodeCollection|mixed $id
	 * @property _AuthCodeCollection|mixed $user_id
	 * @property _AuthCodeCollection|mixed $client_id
	 * @property _AuthCodeCollection|mixed $scopes
	 * @property _AuthCodeCollection|mixed $revoked
	 * @property _AuthCodeCollection|mixed $expires_at
	 * @see \Illuminate\Database\Eloquent\Model::update
	 * @method _AuthCodeCollection update(array $attributes = [], array $options = [])
	 * @see \Illuminate\Database\Eloquent\Model::save
	 * @method _AuthCodeCollection save(array $options = [])
	 * @see \Illuminate\Database\Eloquent\Model::increment
	 * @method _AuthCodeCollection increment(string $column, float|int $amount = 1, array $extra = [])
	 * @see \Illuminate\Database\Eloquent\Model::decrement
	 * @method _AuthCodeCollection decrement(string $column, float|int $amount = 1, array $extra = [])
	 * @see \Illuminate\Database\Eloquent\Concerns\HasTimestamps::touch
	 * @method _AuthCodeCollection touch()
	 * @see \Illuminate\Database\Eloquent\Model::fill
	 * @method _AuthCodeCollection fill(array $attributes)
	 * @see \Illuminate\Database\Eloquent\Model::delete
	 * @method _AuthCodeCollection delete()
	 */
	class _AuthCodeCollectionProxy
	{
	}

	/**
	 * @method _AuthCodeQueryBuilder whereId($value)
	 * @method _AuthCodeQueryBuilder whereUserId($value)
	 * @method _AuthCodeQueryBuilder whereClientId($value)
	 * @method _AuthCodeQueryBuilder whereScopes($value)
	 * @method _AuthCodeQueryBuilder whereRevoked($value)
	 * @method _AuthCodeQueryBuilder whereExpiresAt($value)
	 * @method AuthCode create(array $attributes = [])
	 * @method _AuthCodeCollection|AuthCode[] cursor()
	 * @method AuthCode|null find($id, array $columns = ['*'])
	 * @method _AuthCodeCollection|AuthCode[] findMany(array|Arrayable $ids, array $columns = ['*'])
	 * @method AuthCode findOrFail($id, array $columns = ['*'])
	 * @method _AuthCodeCollection|AuthCode[] findOrNew($id, array $columns = ['*'])
	 * @method AuthCode first(array $columns = ['*'])
	 * @method AuthCode firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
	 * @method AuthCode firstOrCreate(array $attributes, array $values = [])
	 * @method AuthCode firstOrFail(array $columns = ['*'])
	 * @method AuthCode firstOrNew(array $attributes, array $values = [])
	 * @method AuthCode forceCreate(array $attributes)
	 * @method _AuthCodeCollection|AuthCode[] fromQuery(string $query, array $bindings = [])
	 * @method _AuthCodeCollection|AuthCode[] get(array $columns = ['*'])
	 * @method AuthCode getModel()
	 * @method AuthCode[] getModels(array $columns = ['*'])
	 * @method _AuthCodeCollection|AuthCode[] hydrate(array $items)
	 * @method AuthCode make(array $attributes = [])
	 * @method AuthCode newModelInstance(array $attributes = [])
	 * @method AuthCode updateOrCreate(array $attributes, array $values = [])
	 */
	class _AuthCodeQueryBuilder extends _BaseBuilder
	{
	}

	/**
	 * @method Client shift()
	 * @method Client pop()
	 * @method Client get($key, $default = null)
	 * @method Client pull($key, $default = null)
	 * @method Client first(callable $callback = null, $default = null)
	 * @method Client firstWhere(string $key, $operator = null, $value = null)
	 * @method Client[] all()
	 * @method Client last(callable $callback = null, $default = null)
	 * @property-read _ClientCollectionProxy $keyBy
	 * @property-read _ClientCollectionProxy $max
	 * @property-read _ClientCollectionProxy $partition
	 * @property-read _ClientCollectionProxy $average
	 * @property-read _ClientCollectionProxy $flatMap
	 * @property-read _ClientCollectionProxy $each
	 * @property-read _ClientCollectionProxy $map
	 * @property-read _ClientCollectionProxy $sortByDesc
	 * @property-read _ClientCollectionProxy $filter
	 * @property-read _ClientCollectionProxy $avg
	 * @property-read _ClientCollectionProxy $unique
	 * @property-read _ClientCollectionProxy $first
	 * @property-read _ClientCollectionProxy $min
	 * @property-read _ClientCollectionProxy $groupBy
	 * @property-read _ClientCollectionProxy $reject
	 * @property-read _ClientCollectionProxy $sortBy
	 * @property-read _ClientCollectionProxy $contains
	 * @property-read _ClientCollectionProxy $sum
	 * @property-read _ClientCollectionProxy $every
	 */
	class _ClientCollection extends _BaseCollection
	{
		/**
		 * @param int $size
		 *
		 * @return Client[][]
		 */
		public function chunk($size)
		{
			return [];
		}
	}

	/**
	 * @property _ClientCollection|mixed $id
	 * @property _ClientCollection|mixed $user_id
	 * @property _ClientCollection|mixed $name
	 * @property _ClientCollection|mixed $secret
	 * @property _ClientCollection|mixed $redirect
	 * @property _ClientCollection|mixed $personal_access_client
	 * @property _ClientCollection|mixed $password_client
	 * @property _ClientCollection|mixed $revoked
	 * @property _ClientCollection|mixed $created_at
	 * @property _ClientCollection|mixed $updated_at
	 * @see \Illuminate\Database\Eloquent\Model::update
	 * @method _ClientCollection update(array $attributes = [], array $options = [])
	 * @see \Illuminate\Database\Eloquent\Model::save
	 * @method _ClientCollection save(array $options = [])
	 * @see \Illuminate\Database\Eloquent\Model::increment
	 * @method _ClientCollection increment(string $column, float|int $amount = 1, array $extra = [])
	 * @see \Illuminate\Database\Eloquent\Model::decrement
	 * @method _ClientCollection decrement(string $column, float|int $amount = 1, array $extra = [])
	 * @see \Illuminate\Database\Eloquent\Concerns\HasTimestamps::touch
	 * @method _ClientCollection touch()
	 * @see \Illuminate\Database\Eloquent\Model::fill
	 * @method _ClientCollection fill(array $attributes)
	 * @see \Illuminate\Database\Eloquent\Model::delete
	 * @method _ClientCollection delete()
	 */
	class _ClientCollectionProxy
	{
	}

	/**
	 * @method _ClientQueryBuilder whereId($value)
	 * @method _ClientQueryBuilder whereUserId($value)
	 * @method _ClientQueryBuilder whereName($value)
	 * @method _ClientQueryBuilder whereSecret($value)
	 * @method _ClientQueryBuilder whereRedirect($value)
	 * @method _ClientQueryBuilder wherePersonalAccessClient($value)
	 * @method _ClientQueryBuilder wherePasswordClient($value)
	 * @method _ClientQueryBuilder whereRevoked($value)
	 * @method _ClientQueryBuilder whereCreatedAt($value)
	 * @method _ClientQueryBuilder whereUpdatedAt($value)
	 * @method Client create(array $attributes = [])
	 * @method _ClientCollection|Client[] cursor()
	 * @method Client|null find($id, array $columns = ['*'])
	 * @method _ClientCollection|Client[] findMany(array|Arrayable $ids, array $columns = ['*'])
	 * @method Client findOrFail($id, array $columns = ['*'])
	 * @method _ClientCollection|Client[] findOrNew($id, array $columns = ['*'])
	 * @method Client first(array $columns = ['*'])
	 * @method Client firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
	 * @method Client firstOrCreate(array $attributes, array $values = [])
	 * @method Client firstOrFail(array $columns = ['*'])
	 * @method Client firstOrNew(array $attributes, array $values = [])
	 * @method Client forceCreate(array $attributes)
	 * @method _ClientCollection|Client[] fromQuery(string $query, array $bindings = [])
	 * @method _ClientCollection|Client[] get(array $columns = ['*'])
	 * @method Client getModel()
	 * @method Client[] getModels(array $columns = ['*'])
	 * @method _ClientCollection|Client[] hydrate(array $items)
	 * @method Client make(array $attributes = [])
	 * @method Client newModelInstance(array $attributes = [])
	 * @method Client updateOrCreate(array $attributes, array $values = [])
	 */
	class _ClientQueryBuilder extends _BaseBuilder
	{
	}

	/**
	 * @method PersonalAccessClient shift()
	 * @method PersonalAccessClient pop()
	 * @method PersonalAccessClient get($key, $default = null)
	 * @method PersonalAccessClient pull($key, $default = null)
	 * @method PersonalAccessClient first(callable $callback = null, $default = null)
	 * @method PersonalAccessClient firstWhere(string $key, $operator = null, $value = null)
	 * @method PersonalAccessClient[] all()
	 * @method PersonalAccessClient last(callable $callback = null, $default = null)
	 * @property-read _PersonalAccessClientCollectionProxy $keyBy
	 * @property-read _PersonalAccessClientCollectionProxy $max
	 * @property-read _PersonalAccessClientCollectionProxy $partition
	 * @property-read _PersonalAccessClientCollectionProxy $average
	 * @property-read _PersonalAccessClientCollectionProxy $flatMap
	 * @property-read _PersonalAccessClientCollectionProxy $each
	 * @property-read _PersonalAccessClientCollectionProxy $map
	 * @property-read _PersonalAccessClientCollectionProxy $sortByDesc
	 * @property-read _PersonalAccessClientCollectionProxy $filter
	 * @property-read _PersonalAccessClientCollectionProxy $avg
	 * @property-read _PersonalAccessClientCollectionProxy $unique
	 * @property-read _PersonalAccessClientCollectionProxy $first
	 * @property-read _PersonalAccessClientCollectionProxy $min
	 * @property-read _PersonalAccessClientCollectionProxy $groupBy
	 * @property-read _PersonalAccessClientCollectionProxy $reject
	 * @property-read _PersonalAccessClientCollectionProxy $sortBy
	 * @property-read _PersonalAccessClientCollectionProxy $contains
	 * @property-read _PersonalAccessClientCollectionProxy $sum
	 * @property-read _PersonalAccessClientCollectionProxy $every
	 */
	class _PersonalAccessClientCollection extends _BaseCollection
	{
		/**
		 * @param int $size
		 *
		 * @return PersonalAccessClient[][]
		 */
		public function chunk($size)
		{
			return [];
		}
	}

	/**
	 * @property _PersonalAccessClientCollection|mixed $id
	 * @property _PersonalAccessClientCollection|mixed $client_id
	 * @property _PersonalAccessClientCollection|mixed $created_at
	 * @property _PersonalAccessClientCollection|mixed $updated_at
	 * @see \Illuminate\Database\Eloquent\Model::update
	 * @method _PersonalAccessClientCollection update(array $attributes = [], array $options = [])
	 * @see \Illuminate\Database\Eloquent\Model::save
	 * @method _PersonalAccessClientCollection save(array $options = [])
	 * @see \Illuminate\Database\Eloquent\Model::increment
	 * @method _PersonalAccessClientCollection increment(string $column, float|int $amount = 1, array $extra = [])
	 * @see \Illuminate\Database\Eloquent\Model::decrement
	 * @method _PersonalAccessClientCollection decrement(string $column, float|int $amount = 1, array $extra = [])
	 * @see \Illuminate\Database\Eloquent\Concerns\HasTimestamps::touch
	 * @method _PersonalAccessClientCollection touch()
	 * @see \Illuminate\Database\Eloquent\Model::fill
	 * @method _PersonalAccessClientCollection fill(array $attributes)
	 * @see \Illuminate\Database\Eloquent\Model::delete
	 * @method _PersonalAccessClientCollection delete()
	 */
	class _PersonalAccessClientCollectionProxy
	{
	}

	/**
	 * @method _PersonalAccessClientQueryBuilder whereId($value)
	 * @method _PersonalAccessClientQueryBuilder whereClientId($value)
	 * @method _PersonalAccessClientQueryBuilder whereCreatedAt($value)
	 * @method _PersonalAccessClientQueryBuilder whereUpdatedAt($value)
	 * @method PersonalAccessClient create(array $attributes = [])
	 * @method _PersonalAccessClientCollection|PersonalAccessClient[] cursor()
	 * @method PersonalAccessClient|null find($id, array $columns = ['*'])
	 * @method _PersonalAccessClientCollection|PersonalAccessClient[] findMany(array|Arrayable $ids, array $columns = ['*'])
	 * @method PersonalAccessClient findOrFail($id, array $columns = ['*'])
	 * @method _PersonalAccessClientCollection|PersonalAccessClient[] findOrNew($id, array $columns = ['*'])
	 * @method PersonalAccessClient first(array $columns = ['*'])
	 * @method PersonalAccessClient firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
	 * @method PersonalAccessClient firstOrCreate(array $attributes, array $values = [])
	 * @method PersonalAccessClient firstOrFail(array $columns = ['*'])
	 * @method PersonalAccessClient firstOrNew(array $attributes, array $values = [])
	 * @method PersonalAccessClient forceCreate(array $attributes)
	 * @method _PersonalAccessClientCollection|PersonalAccessClient[] fromQuery(string $query, array $bindings = [])
	 * @method _PersonalAccessClientCollection|PersonalAccessClient[] get(array $columns = ['*'])
	 * @method PersonalAccessClient getModel()
	 * @method PersonalAccessClient[] getModels(array $columns = ['*'])
	 * @method _PersonalAccessClientCollection|PersonalAccessClient[] hydrate(array $items)
	 * @method PersonalAccessClient make(array $attributes = [])
	 * @method PersonalAccessClient newModelInstance(array $attributes = [])
	 * @method PersonalAccessClient updateOrCreate(array $attributes, array $values = [])
	 */
	class _PersonalAccessClientQueryBuilder extends _BaseBuilder
	{
	}

	/**
	 * @method Token shift()
	 * @method Token pop()
	 * @method Token get($key, $default = null)
	 * @method Token pull($key, $default = null)
	 * @method Token first(callable $callback = null, $default = null)
	 * @method Token firstWhere(string $key, $operator = null, $value = null)
	 * @method Token[] all()
	 * @method Token last(callable $callback = null, $default = null)
	 * @property-read _TokenCollectionProxy $keyBy
	 * @property-read _TokenCollectionProxy $max
	 * @property-read _TokenCollectionProxy $partition
	 * @property-read _TokenCollectionProxy $average
	 * @property-read _TokenCollectionProxy $flatMap
	 * @property-read _TokenCollectionProxy $each
	 * @property-read _TokenCollectionProxy $map
	 * @property-read _TokenCollectionProxy $sortByDesc
	 * @property-read _TokenCollectionProxy $filter
	 * @property-read _TokenCollectionProxy $avg
	 * @property-read _TokenCollectionProxy $unique
	 * @property-read _TokenCollectionProxy $first
	 * @property-read _TokenCollectionProxy $min
	 * @property-read _TokenCollectionProxy $groupBy
	 * @property-read _TokenCollectionProxy $reject
	 * @property-read _TokenCollectionProxy $sortBy
	 * @property-read _TokenCollectionProxy $contains
	 * @property-read _TokenCollectionProxy $sum
	 * @property-read _TokenCollectionProxy $every
	 */
	class _TokenCollection extends _BaseCollection
	{
		/**
		 * @param int $size
		 *
		 * @return Token[][]
		 */
		public function chunk($size)
		{
			return [];
		}
	}

	/**
	 * @property _TokenCollection|mixed $id
	 * @property _TokenCollection|mixed $user_id
	 * @property _TokenCollection|mixed $client_id
	 * @property _TokenCollection|mixed $name
	 * @property _TokenCollection|mixed $scopes
	 * @property _TokenCollection|mixed $revoked
	 * @property _TokenCollection|mixed $created_at
	 * @property _TokenCollection|mixed $updated_at
	 * @property _TokenCollection|mixed $expires_at
	 * @see \Illuminate\Database\Eloquent\Model::update
	 * @method _TokenCollection update(array $attributes = [], array $options = [])
	 * @see \Illuminate\Database\Eloquent\Model::save
	 * @method _TokenCollection save(array $options = [])
	 * @see \Illuminate\Database\Eloquent\Model::increment
	 * @method _TokenCollection increment(string $column, float|int $amount = 1, array $extra = [])
	 * @see \Illuminate\Database\Eloquent\Model::decrement
	 * @method _TokenCollection decrement(string $column, float|int $amount = 1, array $extra = [])
	 * @see \Illuminate\Database\Eloquent\Concerns\HasTimestamps::touch
	 * @method _TokenCollection touch()
	 * @see \Illuminate\Database\Eloquent\Model::fill
	 * @method _TokenCollection fill(array $attributes)
	 * @see \Illuminate\Database\Eloquent\Model::delete
	 * @method _TokenCollection delete()
	 */
	class _TokenCollectionProxy
	{
	}

	/**
	 * @method _TokenQueryBuilder whereId($value)
	 * @method _TokenQueryBuilder whereUserId($value)
	 * @method _TokenQueryBuilder whereClientId($value)
	 * @method _TokenQueryBuilder whereName($value)
	 * @method _TokenQueryBuilder whereScopes($value)
	 * @method _TokenQueryBuilder whereRevoked($value)
	 * @method _TokenQueryBuilder whereCreatedAt($value)
	 * @method _TokenQueryBuilder whereUpdatedAt($value)
	 * @method _TokenQueryBuilder whereExpiresAt($value)
	 * @method Token create(array $attributes = [])
	 * @method _TokenCollection|Token[] cursor()
	 * @method Token|null find($id, array $columns = ['*'])
	 * @method _TokenCollection|Token[] findMany(array|Arrayable $ids, array $columns = ['*'])
	 * @method Token findOrFail($id, array $columns = ['*'])
	 * @method _TokenCollection|Token[] findOrNew($id, array $columns = ['*'])
	 * @method Token first(array $columns = ['*'])
	 * @method Token firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
	 * @method Token firstOrCreate(array $attributes, array $values = [])
	 * @method Token firstOrFail(array $columns = ['*'])
	 * @method Token firstOrNew(array $attributes, array $values = [])
	 * @method Token forceCreate(array $attributes)
	 * @method _TokenCollection|Token[] fromQuery(string $query, array $bindings = [])
	 * @method _TokenCollection|Token[] get(array $columns = ['*'])
	 * @method Token getModel()
	 * @method Token[] getModels(array $columns = ['*'])
	 * @method _TokenCollection|Token[] hydrate(array $items)
	 * @method Token make(array $attributes = [])
	 * @method Token newModelInstance(array $attributes = [])
	 * @method Token updateOrCreate(array $attributes, array $values = [])
	 */
	class _TokenQueryBuilder extends _BaseBuilder
	{
	}
}

namespace Laravel\Passport
{

	use Illuminate\Contracts\Support\Arrayable;
	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Database\Eloquent\Scope;
	use Illuminate\Support\Carbon;
	use LaravelIdea\Helper\Laravel\Passport\_AuthCodeCollection;
	use LaravelIdea\Helper\Laravel\Passport\_AuthCodeQueryBuilder;
	use LaravelIdea\Helper\Laravel\Passport\_ClientCollection;
	use LaravelIdea\Helper\Laravel\Passport\_ClientQueryBuilder;
	use LaravelIdea\Helper\Laravel\Passport\_PersonalAccessClientCollection;
	use LaravelIdea\Helper\Laravel\Passport\_PersonalAccessClientQueryBuilder;
	use LaravelIdea\Helper\Laravel\Passport\_TokenCollection;
	use LaravelIdea\Helper\Laravel\Passport\_TokenQueryBuilder;

	/**
	 * @property string      $id
	 * @property int         $user_id
	 * @property int         $client_id
	 * @property string|null $scopes
	 * @property bool        $revoked
	 * @property Carbon|null $expires_at
	 * @method _AuthCodeQueryBuilder newModelQuery()
	 * @method _AuthCodeQueryBuilder newQuery()
	 * @method static _AuthCodeQueryBuilder query()
	 * @method static _AuthCodeCollection|AuthCode[] all()
	 * @method static _AuthCodeQueryBuilder whereId($value)
	 * @method static _AuthCodeQueryBuilder whereUserId($value)
	 * @method static _AuthCodeQueryBuilder whereClientId($value)
	 * @method static _AuthCodeQueryBuilder whereScopes($value)
	 * @method static _AuthCodeQueryBuilder whereRevoked($value)
	 * @method static _AuthCodeQueryBuilder whereExpiresAt($value)
	 * @method static bool chunk(int $count, callable $callback)
	 * @method static bool chunkById(int $count, callable $callback, null|string $column = null, null|string $alias = null)
	 * @method static int count(string $columns = '*')
	 * @method static AuthCode create(array $attributes = [])
	 * @method static _AuthCodeQueryBuilder crossJoin(string $table, \Closure|null|string $first = null, null|string $operator = null, null|string
	 *         $second = null)
	 * @method static _AuthCodeCollection|AuthCode[] cursor()
	 * @method static int decrement(string $column, float|int $amount = 1, array $extra = [])
	 * @method static bool doesntExist()
	 * @method static _AuthCodeQueryBuilder each(callable $callback, int $count = 1000)
	 * @method static bool eachById(callable $callback, int $count = 1000, string $column = null, string $alias = null)
	 * @method static bool exists()
	 * @method static AuthCode|null find($id, array $columns = ['*'])
	 * @method static _AuthCodeCollection|AuthCode[] findMany(array|Arrayable $ids, array $columns = ['*'])
	 * @method static AuthCode findOrFail($id, array $columns = ['*'])
	 * @method static _AuthCodeCollection|AuthCode[] findOrNew($id, array $columns = ['*'])
	 * @method static AuthCode first(array $columns = ['*'])
	 * @method static AuthCode firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
	 * @method static AuthCode firstOrCreate(array $attributes, array $values = [])
	 * @method static AuthCode firstOrFail(array $columns = ['*'])
	 * @method static AuthCode firstOrNew(array $attributes, array $values = [])
	 * @method static AuthCode forceCreate(array $attributes)
	 * @method static _AuthCodeCollection|AuthCode[] fromQuery(string $query, array $bindings = [])
	 * @method static _AuthCodeCollection|AuthCode[] get(array $columns = ['*'])
	 * @method static int getCountForPagination(array $columns = ['*'])
	 * @method static AuthCode getModel()
	 * @method static AuthCode[] getModels(array $columns = ['*'])
	 * @method static _AuthCodeQueryBuilder getQuery()
	 * @method static _AuthCodeQueryBuilder groupBy(array $groups)
	 * @method static bool hasMacro(string $name)
	 * @method static _AuthCodeCollection|AuthCode[] hydrate(array $items)
	 * @method static int increment(string $column, float|int $amount = 1, array $extra = [])
	 * @method static bool insert(array $values)
	 * @method static int insertGetId(array $values, null|string $sequence = null)
	 * @method static int insertOrIgnore(array $values)
	 * @method static int insertUsing(array $columns, \Closure|\Illuminate\Database\Query\Builder|string $query)
	 * @method static _AuthCodeQueryBuilder join(string $table, \Closure|string $first, null|string $operator = null, null|string $second = null,
	 *         string $type = 'inner', bool $where = false)
	 * @method static _AuthCodeQueryBuilder latest(string $column = null)
	 * @method static _AuthCodeQueryBuilder leftJoin(string $table, \Closure|string $first, null|string $operator = null, null|string $second = null)
	 * @method static _AuthCodeQueryBuilder limit(int $value)
	 * @method static AuthCode make(array $attributes = [])
	 * @method static AuthCode newModelInstance(array $attributes = [])
	 * @method static int numericAggregate(string $function, array $columns = ['*'])
	 * @method static _AuthCodeQueryBuilder offset(int $value)
	 * @method static _AuthCodeQueryBuilder oldest(string $column = null)
	 * @method static _AuthCodeQueryBuilder orderBy(\Closure|\Illuminate\Database\Query\Builder|string $column, string $direction = 'asc')
	 * @method static _AuthCodeQueryBuilder orderByDesc(string $column)
	 * @method static _AuthCodeQueryBuilder orderByRaw(string $sql, array $bindings = [])
	 * @method static _AuthCodeQueryBuilder paginate(int $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
	 * @method static _AuthCodeQueryBuilder rightJoin(string $table, \Closure|string $first, null|string $operator = null, null|string $second =
	 *         null)
	 * @method static _AuthCodeQueryBuilder select(array $columns = ['*'])
	 * @method static _AuthCodeQueryBuilder setQuery(\Illuminate\Database\Query\Builder $query)
	 * @method static _AuthCodeQueryBuilder simplePaginate(int $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page =
	 *         null)
	 * @method static _AuthCodeQueryBuilder skip(int $value)
	 * @method static int sum(string $column)
	 * @method static _AuthCodeQueryBuilder take(int $value)
	 * @method static _AuthCodeQueryBuilder tap(callable $callback)
	 * @method static _AuthCodeQueryBuilder truncate()
	 * @method static _AuthCodeQueryBuilder unless($value, callable $callback, callable|null $default = null)
	 * @method static int update(array $values)
	 * @method static AuthCode updateOrCreate(array $attributes, array $values = [])
	 * @method static bool updateOrInsert(array $attributes, array $values = [])
	 * @method static _AuthCodeQueryBuilder when($value, callable $callback, callable|null $default = null)
	 * @method static _AuthCodeQueryBuilder where(array|\Closure|string $column, $operator = null, $value = null, string $boolean = 'and')
	 * @method static _AuthCodeQueryBuilder whereBetween(string $column, array $values, string $boolean = 'and', bool $not = false)
	 * @method static _AuthCodeQueryBuilder whereColumn(array|string $first, null|string $operator = null, null|string $second = null, null|string
	 *         $boolean = 'and')
	 * @method static _AuthCodeQueryBuilder whereDate(string $column, string $operator, \DateTimeInterface|null|string $value = null, string $boolean
	 *         = 'and')
	 * @method static _AuthCodeQueryBuilder whereDay(string $column, string $operator, \DateTimeInterface|null|string $value = null, string $boolean
	 *         = 'and')
	 * @method static _AuthCodeQueryBuilder whereDoesntHave(string $relation, \Closure $callback = null)
	 * @method static _AuthCodeQueryBuilder whereDoesntHaveMorph(string $relation, array|string $types, \Closure $callback = null)
	 * @method static _AuthCodeQueryBuilder whereExists(\Closure $callback, string $boolean = 'and', bool $not = false)
	 * @method static _AuthCodeQueryBuilder whereHas(string $relation, \Closure $callback = null, string $operator = '>=', int $count = 1)
	 * @method static _AuthCodeQueryBuilder whereHasMorph(string $relation, array|string $types, \Closure $callback = null, string $operator = '>=',
	 *         int $count = 1)
	 * @method static _AuthCodeQueryBuilder whereIn(string $column, $values, string $boolean = 'and', bool $not = false)
	 * @method static _AuthCodeQueryBuilder whereIntegerInRaw(string $column, array|Arrayable $values, string $boolean = 'and', bool $not = false)
	 * @method static _AuthCodeQueryBuilder whereIntegerNotInRaw(string $column, array|Arrayable $values, string $boolean = 'and')
	 * @method static _AuthCodeQueryBuilder whereJsonContains(string $column, $value, string $boolean = 'and', bool $not = false)
	 * @method static _AuthCodeQueryBuilder whereJsonDoesntContain(string $column, $value, string $boolean = 'and')
	 * @method static _AuthCodeQueryBuilder whereJsonLength(string $column, $operator, $value = null, string $boolean = 'and')
	 * @method static _AuthCodeQueryBuilder whereKey($id)
	 * @method static _AuthCodeQueryBuilder whereKeyNot($id)
	 * @method static _AuthCodeQueryBuilder whereMonth(string $column, string $operator, \DateTimeInterface|null|string $value = null, string
	 *         $boolean = 'and')
	 * @method static _AuthCodeQueryBuilder whereNested(\Closure $callback, string $boolean = 'and')
	 * @method static _AuthCodeQueryBuilder whereNotBetween(string $column, array $values, string $boolean = 'and')
	 * @method static _AuthCodeQueryBuilder whereNotExists(\Closure $callback, string $boolean = 'and')
	 * @method static _AuthCodeQueryBuilder whereNotIn(string $column, $values, string $boolean = 'and')
	 * @method static _AuthCodeQueryBuilder whereNotNull(string $column, string $boolean = 'and')
	 * @method static _AuthCodeQueryBuilder whereNull(array|string $columns, string $boolean = 'and', bool $not = false)
	 * @method static _AuthCodeQueryBuilder whereRaw(string $sql, $bindings = [], string $boolean = 'and')
	 * @method static _AuthCodeQueryBuilder whereRowValues(array $columns, string $operator, array $values, string $boolean = 'and')
	 * @method static _AuthCodeQueryBuilder whereTime(string $column, string $operator, \DateTimeInterface|null|string $value = null, string $boolean
	 *         = 'and')
	 * @method static _AuthCodeQueryBuilder whereYear(string $column, string $operator, \DateTimeInterface|int|null|string $value = null, string
	 *         $boolean = 'and')
	 * @method static _AuthCodeQueryBuilder with($relations)
	 * @method static _AuthCodeQueryBuilder withCount($relations)
	 * @method static _AuthCodeQueryBuilder withGlobalScope(string $identifier, \Closure|Scope $scope)
	 * @method static _AuthCodeQueryBuilder without($relations)
	 * @method static _AuthCodeQueryBuilder withoutGlobalScope(Scope|string $scope)
	 * @method static _AuthCodeQueryBuilder withoutGlobalScopes(array $scopes = null)
	 */
	class AuthCode extends Model
	{
	}

	/**
	 * @property int         $id
	 * @property int|null    $user_id
	 * @property string      $name
	 * @property string      $secret
	 * @property string      $redirect
	 * @property bool        $personal_access_client
	 * @property bool        $password_client
	 * @property bool        $revoked
	 * @property Carbon|null $created_at
	 * @property Carbon|null $updated_at
	 * @method _ClientQueryBuilder newModelQuery()
	 * @method _ClientQueryBuilder newQuery()
	 * @method static _ClientQueryBuilder query()
	 * @method static _ClientCollection|Client[] all()
	 * @method static _ClientQueryBuilder whereId($value)
	 * @method static _ClientQueryBuilder whereUserId($value)
	 * @method static _ClientQueryBuilder whereName($value)
	 * @method static _ClientQueryBuilder whereSecret($value)
	 * @method static _ClientQueryBuilder whereRedirect($value)
	 * @method static _ClientQueryBuilder wherePersonalAccessClient($value)
	 * @method static _ClientQueryBuilder wherePasswordClient($value)
	 * @method static _ClientQueryBuilder whereRevoked($value)
	 * @method static _ClientQueryBuilder whereCreatedAt($value)
	 * @method static _ClientQueryBuilder whereUpdatedAt($value)
	 * @method static bool chunk(int $count, callable $callback)
	 * @method static bool chunkById(int $count, callable $callback, null|string $column = null, null|string $alias = null)
	 * @method static int count(string $columns = '*')
	 * @method static Client create(array $attributes = [])
	 * @method static _ClientQueryBuilder crossJoin(string $table, \Closure|null|string $first = null, null|string $operator = null, null|string
	 *         $second = null)
	 * @method static _ClientCollection|Client[] cursor()
	 * @method static int decrement(string $column, float|int $amount = 1, array $extra = [])
	 * @method static bool doesntExist()
	 * @method static _ClientQueryBuilder each(callable $callback, int $count = 1000)
	 * @method static bool eachById(callable $callback, int $count = 1000, string $column = null, string $alias = null)
	 * @method static bool exists()
	 * @method static Client|null find($id, array $columns = ['*'])
	 * @method static _ClientCollection|Client[] findMany(array|Arrayable $ids, array $columns = ['*'])
	 * @method static Client findOrFail($id, array $columns = ['*'])
	 * @method static _ClientCollection|Client[] findOrNew($id, array $columns = ['*'])
	 * @method static Client first(array $columns = ['*'])
	 * @method static Client firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
	 * @method static Client firstOrCreate(array $attributes, array $values = [])
	 * @method static Client firstOrFail(array $columns = ['*'])
	 * @method static Client firstOrNew(array $attributes, array $values = [])
	 * @method static Client forceCreate(array $attributes)
	 * @method static _ClientCollection|Client[] fromQuery(string $query, array $bindings = [])
	 * @method static _ClientCollection|Client[] get(array $columns = ['*'])
	 * @method static int getCountForPagination(array $columns = ['*'])
	 * @method static Client getModel()
	 * @method static Client[] getModels(array $columns = ['*'])
	 * @method static _ClientQueryBuilder getQuery()
	 * @method static _ClientQueryBuilder groupBy(array $groups)
	 * @method static bool hasMacro(string $name)
	 * @method static _ClientCollection|Client[] hydrate(array $items)
	 * @method static int increment(string $column, float|int $amount = 1, array $extra = [])
	 * @method static bool insert(array $values)
	 * @method static int insertGetId(array $values, null|string $sequence = null)
	 * @method static int insertOrIgnore(array $values)
	 * @method static int insertUsing(array $columns, \Closure|\Illuminate\Database\Query\Builder|string $query)
	 * @method static _ClientQueryBuilder join(string $table, \Closure|string $first, null|string $operator = null, null|string $second = null,
	 *         string $type = 'inner', bool $where = false)
	 * @method static _ClientQueryBuilder latest(string $column = null)
	 * @method static _ClientQueryBuilder leftJoin(string $table, \Closure|string $first, null|string $operator = null, null|string $second = null)
	 * @method static _ClientQueryBuilder limit(int $value)
	 * @method static Client make(array $attributes = [])
	 * @method static Client newModelInstance(array $attributes = [])
	 * @method static int numericAggregate(string $function, array $columns = ['*'])
	 * @method static _ClientQueryBuilder offset(int $value)
	 * @method static _ClientQueryBuilder oldest(string $column = null)
	 * @method static _ClientQueryBuilder orderBy(\Closure|\Illuminate\Database\Query\Builder|string $column, string $direction = 'asc')
	 * @method static _ClientQueryBuilder orderByDesc(string $column)
	 * @method static _ClientQueryBuilder orderByRaw(string $sql, array $bindings = [])
	 * @method static _ClientQueryBuilder paginate(int $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
	 * @method static _ClientQueryBuilder rightJoin(string $table, \Closure|string $first, null|string $operator = null, null|string $second = null)
	 * @method static _ClientQueryBuilder select(array $columns = ['*'])
	 * @method static _ClientQueryBuilder setQuery(\Illuminate\Database\Query\Builder $query)
	 * @method static _ClientQueryBuilder simplePaginate(int $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page =
	 *         null)
	 * @method static _ClientQueryBuilder skip(int $value)
	 * @method static int sum(string $column)
	 * @method static _ClientQueryBuilder take(int $value)
	 * @method static _ClientQueryBuilder tap(callable $callback)
	 * @method static _ClientQueryBuilder truncate()
	 * @method static _ClientQueryBuilder unless($value, callable $callback, callable|null $default = null)
	 * @method static int update(array $values)
	 * @method static Client updateOrCreate(array $attributes, array $values = [])
	 * @method static bool updateOrInsert(array $attributes, array $values = [])
	 * @method static _ClientQueryBuilder when($value, callable $callback, callable|null $default = null)
	 * @method static _ClientQueryBuilder where(array|\Closure|string $column, $operator = null, $value = null, string $boolean = 'and')
	 * @method static _ClientQueryBuilder whereBetween(string $column, array $values, string $boolean = 'and', bool $not = false)
	 * @method static _ClientQueryBuilder whereColumn(array|string $first, null|string $operator = null, null|string $second = null, null|string
	 *         $boolean = 'and')
	 * @method static _ClientQueryBuilder whereDate(string $column, string $operator, \DateTimeInterface|null|string $value = null, string $boolean =
	 *         'and')
	 * @method static _ClientQueryBuilder whereDay(string $column, string $operator, \DateTimeInterface|null|string $value = null, string $boolean =
	 *         'and')
	 * @method static _ClientQueryBuilder whereDoesntHave(string $relation, \Closure $callback = null)
	 * @method static _ClientQueryBuilder whereDoesntHaveMorph(string $relation, array|string $types, \Closure $callback = null)
	 * @method static _ClientQueryBuilder whereExists(\Closure $callback, string $boolean = 'and', bool $not = false)
	 * @method static _ClientQueryBuilder whereHas(string $relation, \Closure $callback = null, string $operator = '>=', int $count = 1)
	 * @method static _ClientQueryBuilder whereHasMorph(string $relation, array|string $types, \Closure $callback = null, string $operator = '>=',
	 *         int $count = 1)
	 * @method static _ClientQueryBuilder whereIn(string $column, $values, string $boolean = 'and', bool $not = false)
	 * @method static _ClientQueryBuilder whereIntegerInRaw(string $column, array|Arrayable $values, string $boolean = 'and', bool $not = false)
	 * @method static _ClientQueryBuilder whereIntegerNotInRaw(string $column, array|Arrayable $values, string $boolean = 'and')
	 * @method static _ClientQueryBuilder whereJsonContains(string $column, $value, string $boolean = 'and', bool $not = false)
	 * @method static _ClientQueryBuilder whereJsonDoesntContain(string $column, $value, string $boolean = 'and')
	 * @method static _ClientQueryBuilder whereJsonLength(string $column, $operator, $value = null, string $boolean = 'and')
	 * @method static _ClientQueryBuilder whereKey($id)
	 * @method static _ClientQueryBuilder whereKeyNot($id)
	 * @method static _ClientQueryBuilder whereMonth(string $column, string $operator, \DateTimeInterface|null|string $value = null, string $boolean
	 *         = 'and')
	 * @method static _ClientQueryBuilder whereNested(\Closure $callback, string $boolean = 'and')
	 * @method static _ClientQueryBuilder whereNotBetween(string $column, array $values, string $boolean = 'and')
	 * @method static _ClientQueryBuilder whereNotExists(\Closure $callback, string $boolean = 'and')
	 * @method static _ClientQueryBuilder whereNotIn(string $column, $values, string $boolean = 'and')
	 * @method static _ClientQueryBuilder whereNotNull(string $column, string $boolean = 'and')
	 * @method static _ClientQueryBuilder whereNull(array|string $columns, string $boolean = 'and', bool $not = false)
	 * @method static _ClientQueryBuilder whereRaw(string $sql, $bindings = [], string $boolean = 'and')
	 * @method static _ClientQueryBuilder whereRowValues(array $columns, string $operator, array $values, string $boolean = 'and')
	 * @method static _ClientQueryBuilder whereTime(string $column, string $operator, \DateTimeInterface|null|string $value = null, string $boolean =
	 *         'and')
	 * @method static _ClientQueryBuilder whereYear(string $column, string $operator, \DateTimeInterface|int|null|string $value = null, string
	 *         $boolean = 'and')
	 * @method static _ClientQueryBuilder with($relations)
	 * @method static _ClientQueryBuilder withCount($relations)
	 * @method static _ClientQueryBuilder withGlobalScope(string $identifier, \Closure|Scope $scope)
	 * @method static _ClientQueryBuilder without($relations)
	 * @method static _ClientQueryBuilder withoutGlobalScope(Scope|string $scope)
	 * @method static _ClientQueryBuilder withoutGlobalScopes(array $scopes = null)
	 */
	class Client extends Model
	{
	}

	/**
	 * @property int         $id
	 * @property int         $client_id
	 * @property Carbon|null $created_at
	 * @property Carbon|null $updated_at
	 * @method _PersonalAccessClientQueryBuilder newModelQuery()
	 * @method _PersonalAccessClientQueryBuilder newQuery()
	 * @method static _PersonalAccessClientQueryBuilder query()
	 * @method static _PersonalAccessClientCollection|PersonalAccessClient[] all()
	 * @method static _PersonalAccessClientQueryBuilder whereId($value)
	 * @method static _PersonalAccessClientQueryBuilder whereClientId($value)
	 * @method static _PersonalAccessClientQueryBuilder whereCreatedAt($value)
	 * @method static _PersonalAccessClientQueryBuilder whereUpdatedAt($value)
	 * @method static bool chunk(int $count, callable $callback)
	 * @method static bool chunkById(int $count, callable $callback, null|string $column = null, null|string $alias = null)
	 * @method static int count(string $columns = '*')
	 * @method static PersonalAccessClient create(array $attributes = [])
	 * @method static _PersonalAccessClientQueryBuilder crossJoin(string $table, \Closure|null|string $first = null, null|string $operator = null,
	 *         null|string $second = null)
	 * @method static _PersonalAccessClientCollection|PersonalAccessClient[] cursor()
	 * @method static int decrement(string $column, float|int $amount = 1, array $extra = [])
	 * @method static bool doesntExist()
	 * @method static _PersonalAccessClientQueryBuilder each(callable $callback, int $count = 1000)
	 * @method static bool eachById(callable $callback, int $count = 1000, string $column = null, string $alias = null)
	 * @method static bool exists()
	 * @method static PersonalAccessClient|null find($id, array $columns = ['*'])
	 * @method static _PersonalAccessClientCollection|PersonalAccessClient[] findMany(array|Arrayable $ids, array $columns = ['*'])
	 * @method static PersonalAccessClient findOrFail($id, array $columns = ['*'])
	 * @method static _PersonalAccessClientCollection|PersonalAccessClient[] findOrNew($id, array $columns = ['*'])
	 * @method static PersonalAccessClient first(array $columns = ['*'])
	 * @method static PersonalAccessClient firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
	 * @method static PersonalAccessClient firstOrCreate(array $attributes, array $values = [])
	 * @method static PersonalAccessClient firstOrFail(array $columns = ['*'])
	 * @method static PersonalAccessClient firstOrNew(array $attributes, array $values = [])
	 * @method static PersonalAccessClient forceCreate(array $attributes)
	 * @method static _PersonalAccessClientCollection|PersonalAccessClient[] fromQuery(string $query, array $bindings = [])
	 * @method static _PersonalAccessClientCollection|PersonalAccessClient[] get(array $columns = ['*'])
	 * @method static int getCountForPagination(array $columns = ['*'])
	 * @method static PersonalAccessClient getModel()
	 * @method static PersonalAccessClient[] getModels(array $columns = ['*'])
	 * @method static _PersonalAccessClientQueryBuilder getQuery()
	 * @method static _PersonalAccessClientQueryBuilder groupBy(array $groups)
	 * @method static bool hasMacro(string $name)
	 * @method static _PersonalAccessClientCollection|PersonalAccessClient[] hydrate(array $items)
	 * @method static int increment(string $column, float|int $amount = 1, array $extra = [])
	 * @method static bool insert(array $values)
	 * @method static int insertGetId(array $values, null|string $sequence = null)
	 * @method static int insertOrIgnore(array $values)
	 * @method static int insertUsing(array $columns, \Closure|\Illuminate\Database\Query\Builder|string $query)
	 * @method static _PersonalAccessClientQueryBuilder join(string $table, \Closure|string $first, null|string $operator = null, null|string $second
	 *         = null, string $type = 'inner', bool $where = false)
	 * @method static _PersonalAccessClientQueryBuilder latest(string $column = null)
	 * @method static _PersonalAccessClientQueryBuilder leftJoin(string $table, \Closure|string $first, null|string $operator = null, null|string
	 *         $second = null)
	 * @method static _PersonalAccessClientQueryBuilder limit(int $value)
	 * @method static PersonalAccessClient make(array $attributes = [])
	 * @method static PersonalAccessClient newModelInstance(array $attributes = [])
	 * @method static int numericAggregate(string $function, array $columns = ['*'])
	 * @method static _PersonalAccessClientQueryBuilder offset(int $value)
	 * @method static _PersonalAccessClientQueryBuilder oldest(string $column = null)
	 * @method static _PersonalAccessClientQueryBuilder orderBy(\Closure|\Illuminate\Database\Query\Builder|string $column, string $direction =
	 *         'asc')
	 * @method static _PersonalAccessClientQueryBuilder orderByDesc(string $column)
	 * @method static _PersonalAccessClientQueryBuilder orderByRaw(string $sql, array $bindings = [])
	 * @method static _PersonalAccessClientQueryBuilder paginate(int $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null
	 *         $page = null)
	 * @method static _PersonalAccessClientQueryBuilder rightJoin(string $table, \Closure|string $first, null|string $operator = null, null|string
	 *         $second = null)
	 * @method static _PersonalAccessClientQueryBuilder select(array $columns = ['*'])
	 * @method static _PersonalAccessClientQueryBuilder setQuery(\Illuminate\Database\Query\Builder $query)
	 * @method static _PersonalAccessClientQueryBuilder simplePaginate(int $perPage = null, array $columns = ['*'], string $pageName = 'page',
	 *         int|null $page = null)
	 * @method static _PersonalAccessClientQueryBuilder skip(int $value)
	 * @method static int sum(string $column)
	 * @method static _PersonalAccessClientQueryBuilder take(int $value)
	 * @method static _PersonalAccessClientQueryBuilder tap(callable $callback)
	 * @method static _PersonalAccessClientQueryBuilder truncate()
	 * @method static _PersonalAccessClientQueryBuilder unless($value, callable $callback, callable|null $default = null)
	 * @method static int update(array $values)
	 * @method static PersonalAccessClient updateOrCreate(array $attributes, array $values = [])
	 * @method static bool updateOrInsert(array $attributes, array $values = [])
	 * @method static _PersonalAccessClientQueryBuilder when($value, callable $callback, callable|null $default = null)
	 * @method static _PersonalAccessClientQueryBuilder where(array|\Closure|string $column, $operator = null, $value = null, string $boolean =
	 *         'and')
	 * @method static _PersonalAccessClientQueryBuilder whereBetween(string $column, array $values, string $boolean = 'and', bool $not = false)
	 * @method static _PersonalAccessClientQueryBuilder whereColumn(array|string $first, null|string $operator = null, null|string $second = null,
	 *         null|string $boolean = 'and')
	 * @method static _PersonalAccessClientQueryBuilder whereDate(string $column, string $operator, \DateTimeInterface|null|string $value = null,
	 *         string $boolean = 'and')
	 * @method static _PersonalAccessClientQueryBuilder whereDay(string $column, string $operator, \DateTimeInterface|null|string $value = null,
	 *         string $boolean = 'and')
	 * @method static _PersonalAccessClientQueryBuilder whereDoesntHave(string $relation, \Closure $callback = null)
	 * @method static _PersonalAccessClientQueryBuilder whereDoesntHaveMorph(string $relation, array|string $types, \Closure $callback = null)
	 * @method static _PersonalAccessClientQueryBuilder whereExists(\Closure $callback, string $boolean = 'and', bool $not = false)
	 * @method static _PersonalAccessClientQueryBuilder whereHas(string $relation, \Closure $callback = null, string $operator = '>=', int $count =
	 *         1)
	 * @method static _PersonalAccessClientQueryBuilder whereHasMorph(string $relation, array|string $types, \Closure $callback = null, string
	 *         $operator = '>=', int $count = 1)
	 * @method static _PersonalAccessClientQueryBuilder whereIn(string $column, $values, string $boolean = 'and', bool $not = false)
	 * @method static _PersonalAccessClientQueryBuilder whereIntegerInRaw(string $column, array|Arrayable $values, string $boolean = 'and', bool $not
	 *         = false)
	 * @method static _PersonalAccessClientQueryBuilder whereIntegerNotInRaw(string $column, array|Arrayable $values, string $boolean = 'and')
	 * @method static _PersonalAccessClientQueryBuilder whereJsonContains(string $column, $value, string $boolean = 'and', bool $not = false)
	 * @method static _PersonalAccessClientQueryBuilder whereJsonDoesntContain(string $column, $value, string $boolean = 'and')
	 * @method static _PersonalAccessClientQueryBuilder whereJsonLength(string $column, $operator, $value = null, string $boolean = 'and')
	 * @method static _PersonalAccessClientQueryBuilder whereKey($id)
	 * @method static _PersonalAccessClientQueryBuilder whereKeyNot($id)
	 * @method static _PersonalAccessClientQueryBuilder whereMonth(string $column, string $operator, \DateTimeInterface|null|string $value = null,
	 *         string $boolean = 'and')
	 * @method static _PersonalAccessClientQueryBuilder whereNested(\Closure $callback, string $boolean = 'and')
	 * @method static _PersonalAccessClientQueryBuilder whereNotBetween(string $column, array $values, string $boolean = 'and')
	 * @method static _PersonalAccessClientQueryBuilder whereNotExists(\Closure $callback, string $boolean = 'and')
	 * @method static _PersonalAccessClientQueryBuilder whereNotIn(string $column, $values, string $boolean = 'and')
	 * @method static _PersonalAccessClientQueryBuilder whereNotNull(string $column, string $boolean = 'and')
	 * @method static _PersonalAccessClientQueryBuilder whereNull(array|string $columns, string $boolean = 'and', bool $not = false)
	 * @method static _PersonalAccessClientQueryBuilder whereRaw(string $sql, $bindings = [], string $boolean = 'and')
	 * @method static _PersonalAccessClientQueryBuilder whereRowValues(array $columns, string $operator, array $values, string $boolean = 'and')
	 * @method static _PersonalAccessClientQueryBuilder whereTime(string $column, string $operator, \DateTimeInterface|null|string $value = null,
	 *         string $boolean = 'and')
	 * @method static _PersonalAccessClientQueryBuilder whereYear(string $column, string $operator, \DateTimeInterface|int|null|string $value = null,
	 *         string $boolean = 'and')
	 * @method static _PersonalAccessClientQueryBuilder with($relations)
	 * @method static _PersonalAccessClientQueryBuilder withCount($relations)
	 * @method static _PersonalAccessClientQueryBuilder withGlobalScope(string $identifier, \Closure|Scope $scope)
	 * @method static _PersonalAccessClientQueryBuilder without($relations)
	 * @method static _PersonalAccessClientQueryBuilder withoutGlobalScope(Scope|string $scope)
	 * @method static _PersonalAccessClientQueryBuilder withoutGlobalScopes(array $scopes = null)
	 */
	class PersonalAccessClient extends Model
	{
	}

	/**
	 * @property string      $id
	 * @property int|null    $user_id
	 * @property int         $client_id
	 * @property string|null $name
	 * @property string|null $scopes
	 * @property bool        $revoked
	 * @property Carbon|null $created_at
	 * @property Carbon|null $updated_at
	 * @property Carbon|null $expires_at
	 * @method _TokenQueryBuilder newModelQuery()
	 * @method _TokenQueryBuilder newQuery()
	 * @method static _TokenQueryBuilder query()
	 * @method static _TokenCollection|Token[] all()
	 * @method static _TokenQueryBuilder whereId($value)
	 * @method static _TokenQueryBuilder whereUserId($value)
	 * @method static _TokenQueryBuilder whereClientId($value)
	 * @method static _TokenQueryBuilder whereName($value)
	 * @method static _TokenQueryBuilder whereScopes($value)
	 * @method static _TokenQueryBuilder whereRevoked($value)
	 * @method static _TokenQueryBuilder whereCreatedAt($value)
	 * @method static _TokenQueryBuilder whereUpdatedAt($value)
	 * @method static _TokenQueryBuilder whereExpiresAt($value)
	 * @method static bool chunk(int $count, callable $callback)
	 * @method static bool chunkById(int $count, callable $callback, null|string $column = null, null|string $alias = null)
	 * @method static int count(string $columns = '*')
	 * @method static Token create(array $attributes = [])
	 * @method static _TokenQueryBuilder crossJoin(string $table, \Closure|null|string $first = null, null|string $operator = null, null|string
	 *         $second = null)
	 * @method static _TokenCollection|Token[] cursor()
	 * @method static int decrement(string $column, float|int $amount = 1, array $extra = [])
	 * @method static bool doesntExist()
	 * @method static _TokenQueryBuilder each(callable $callback, int $count = 1000)
	 * @method static bool eachById(callable $callback, int $count = 1000, string $column = null, string $alias = null)
	 * @method static bool exists()
	 * @method static Token|null find($id, array $columns = ['*'])
	 * @method static _TokenCollection|Token[] findMany(array|Arrayable $ids, array $columns = ['*'])
	 * @method static Token findOrFail($id, array $columns = ['*'])
	 * @method static _TokenCollection|Token[] findOrNew($id, array $columns = ['*'])
	 * @method static Token first(array $columns = ['*'])
	 * @method static Token firstOr(array|\Closure $columns = ['*'], \Closure $callback = null)
	 * @method static Token firstOrCreate(array $attributes, array $values = [])
	 * @method static Token firstOrFail(array $columns = ['*'])
	 * @method static Token firstOrNew(array $attributes, array $values = [])
	 * @method static Token forceCreate(array $attributes)
	 * @method static _TokenCollection|Token[] fromQuery(string $query, array $bindings = [])
	 * @method static _TokenCollection|Token[] get(array $columns = ['*'])
	 * @method static int getCountForPagination(array $columns = ['*'])
	 * @method static Token getModel()
	 * @method static Token[] getModels(array $columns = ['*'])
	 * @method static _TokenQueryBuilder getQuery()
	 * @method static _TokenQueryBuilder groupBy(array $groups)
	 * @method static bool hasMacro(string $name)
	 * @method static _TokenCollection|Token[] hydrate(array $items)
	 * @method static int increment(string $column, float|int $amount = 1, array $extra = [])
	 * @method static bool insert(array $values)
	 * @method static int insertGetId(array $values, null|string $sequence = null)
	 * @method static int insertOrIgnore(array $values)
	 * @method static int insertUsing(array $columns, \Closure|\Illuminate\Database\Query\Builder|string $query)
	 * @method static _TokenQueryBuilder join(string $table, \Closure|string $first, null|string $operator = null, null|string $second = null, string
	 *         $type = 'inner', bool $where = false)
	 * @method static _TokenQueryBuilder latest(string $column = null)
	 * @method static _TokenQueryBuilder leftJoin(string $table, \Closure|string $first, null|string $operator = null, null|string $second = null)
	 * @method static _TokenQueryBuilder limit(int $value)
	 * @method static Token make(array $attributes = [])
	 * @method static Token newModelInstance(array $attributes = [])
	 * @method static int numericAggregate(string $function, array $columns = ['*'])
	 * @method static _TokenQueryBuilder offset(int $value)
	 * @method static _TokenQueryBuilder oldest(string $column = null)
	 * @method static _TokenQueryBuilder orderBy(\Closure|\Illuminate\Database\Query\Builder|string $column, string $direction = 'asc')
	 * @method static _TokenQueryBuilder orderByDesc(string $column)
	 * @method static _TokenQueryBuilder orderByRaw(string $sql, array $bindings = [])
	 * @method static _TokenQueryBuilder paginate(int $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page = null)
	 * @method static _TokenQueryBuilder rightJoin(string $table, \Closure|string $first, null|string $operator = null, null|string $second = null)
	 * @method static _TokenQueryBuilder select(array $columns = ['*'])
	 * @method static _TokenQueryBuilder setQuery(\Illuminate\Database\Query\Builder $query)
	 * @method static _TokenQueryBuilder simplePaginate(int $perPage = null, array $columns = ['*'], string $pageName = 'page', int|null $page =
	 *         null)
	 * @method static _TokenQueryBuilder skip(int $value)
	 * @method static int sum(string $column)
	 * @method static _TokenQueryBuilder take(int $value)
	 * @method static _TokenQueryBuilder tap(callable $callback)
	 * @method static _TokenQueryBuilder truncate()
	 * @method static _TokenQueryBuilder unless($value, callable $callback, callable|null $default = null)
	 * @method static int update(array $values)
	 * @method static Token updateOrCreate(array $attributes, array $values = [])
	 * @method static bool updateOrInsert(array $attributes, array $values = [])
	 * @method static _TokenQueryBuilder when($value, callable $callback, callable|null $default = null)
	 * @method static _TokenQueryBuilder where(array|\Closure|string $column, $operator = null, $value = null, string $boolean = 'and')
	 * @method static _TokenQueryBuilder whereBetween(string $column, array $values, string $boolean = 'and', bool $not = false)
	 * @method static _TokenQueryBuilder whereColumn(array|string $first, null|string $operator = null, null|string $second = null, null|string
	 *         $boolean = 'and')
	 * @method static _TokenQueryBuilder whereDate(string $column, string $operator, \DateTimeInterface|null|string $value = null, string $boolean =
	 *         'and')
	 * @method static _TokenQueryBuilder whereDay(string $column, string $operator, \DateTimeInterface|null|string $value = null, string $boolean =
	 *         'and')
	 * @method static _TokenQueryBuilder whereDoesntHave(string $relation, \Closure $callback = null)
	 * @method static _TokenQueryBuilder whereDoesntHaveMorph(string $relation, array|string $types, \Closure $callback = null)
	 * @method static _TokenQueryBuilder whereExists(\Closure $callback, string $boolean = 'and', bool $not = false)
	 * @method static _TokenQueryBuilder whereHas(string $relation, \Closure $callback = null, string $operator = '>=', int $count = 1)
	 * @method static _TokenQueryBuilder whereHasMorph(string $relation, array|string $types, \Closure $callback = null, string $operator = '>=', int
	 *         $count = 1)
	 * @method static _TokenQueryBuilder whereIn(string $column, $values, string $boolean = 'and', bool $not = false)
	 * @method static _TokenQueryBuilder whereIntegerInRaw(string $column, array|Arrayable $values, string $boolean = 'and', bool $not = false)
	 * @method static _TokenQueryBuilder whereIntegerNotInRaw(string $column, array|Arrayable $values, string $boolean = 'and')
	 * @method static _TokenQueryBuilder whereJsonContains(string $column, $value, string $boolean = 'and', bool $not = false)
	 * @method static _TokenQueryBuilder whereJsonDoesntContain(string $column, $value, string $boolean = 'and')
	 * @method static _TokenQueryBuilder whereJsonLength(string $column, $operator, $value = null, string $boolean = 'and')
	 * @method static _TokenQueryBuilder whereKey($id)
	 * @method static _TokenQueryBuilder whereKeyNot($id)
	 * @method static _TokenQueryBuilder whereMonth(string $column, string $operator, \DateTimeInterface|null|string $value = null, string $boolean =
	 *         'and')
	 * @method static _TokenQueryBuilder whereNested(\Closure $callback, string $boolean = 'and')
	 * @method static _TokenQueryBuilder whereNotBetween(string $column, array $values, string $boolean = 'and')
	 * @method static _TokenQueryBuilder whereNotExists(\Closure $callback, string $boolean = 'and')
	 * @method static _TokenQueryBuilder whereNotIn(string $column, $values, string $boolean = 'and')
	 * @method static _TokenQueryBuilder whereNotNull(string $column, string $boolean = 'and')
	 * @method static _TokenQueryBuilder whereNull(array|string $columns, string $boolean = 'and', bool $not = false)
	 * @method static _TokenQueryBuilder whereRaw(string $sql, $bindings = [], string $boolean = 'and')
	 * @method static _TokenQueryBuilder whereRowValues(array $columns, string $operator, array $values, string $boolean = 'and')
	 * @method static _TokenQueryBuilder whereTime(string $column, string $operator, \DateTimeInterface|null|string $value = null, string $boolean =
	 *         'and')
	 * @method static _TokenQueryBuilder whereYear(string $column, string $operator, \DateTimeInterface|int|null|string $value = null, string
	 *         $boolean = 'and')
	 * @method static _TokenQueryBuilder with($relations)
	 * @method static _TokenQueryBuilder withCount($relations)
	 * @method static _TokenQueryBuilder withGlobalScope(string $identifier, \Closure|Scope $scope)
	 * @method static _TokenQueryBuilder without($relations)
	 * @method static _TokenQueryBuilder withoutGlobalScope(Scope|string $scope)
	 * @method static _TokenQueryBuilder withoutGlobalScopes(array $scopes = null)
	 */
	class Token extends Model
	{
	}
}