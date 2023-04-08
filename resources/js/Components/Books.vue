<template>
<div v-for="book in Books" :key="book.id">
    <tr>
        <td>{{ book.id }}</td>
        <td>{{ book.name }}</td>
        <td>{{ book.image }}</td>
        <td>{{ book.created_at }}</td>
        <td>{{ book.updated_at }}</td>
        <td>
            <div v-for="author in book.authors" >

                {{ author.first_name + author.last_name + author.father_name}}
            </div>
        </td>
<!--        <td>-->

<!--            <a href="{{ route('book.show', ['book' => $book->id]) }}">show</a>-->
<!--        </td>-->
    </tr>

</div>
</template>

<script>
export default {
    props:{
        books: Array
    }
}
</script>

<style scoped>

</style>
