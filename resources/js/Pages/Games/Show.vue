<template>
    <AuthenticatedLayout>

        <menu class="grid grid-cols-3 gap-1.5 w-0 min-w-fit mx-auto mt-12">
            <li v-for="(square, index) in boardState" class="bg-gray-300 size-32 grid place-items-center">
                <button v-if="square === 0" @click="fillSquare(index)"
                    class="place-self-stretch bg-gray-200 hover:bg-gray-300 transition-colors"></button>
                <span v-else v-text="square === -1 ? 'X' : 'O'" class="text-4xl font-bold"> </span>
            </li>
        </menu>

    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, computed } from 'vue';
import Swal from 'sweetalert2';

const props = defineProps({
    game: Object
})

// Game Board Rules
// -1 represent X
// 0 represent space | empty
// 1 represent O

const boardState = ref([0, 0, 0, 0, 0, 0, 0, 0, 0]);

const xTurn = computed(() => boardState.value.reduce((carry, value) => carry + value, 0) === 0);

const lines = [
    //rows
    [0, 1, 2],
    [3, 4, 5],
    [6, 7, 8],

    //columns
    [0, 3, 6],
    [1, 4, 7],
    [2, 5, 8],

    //diagonals
    [0, 4, 8],
    [2, 4, 6]
]

const fillSquare = (index) => {
    boardState.value[index] = xTurn.value ? -1 : 1;

    const winningLines = lines.map((line) => line.reduce((carry, index) => carry + boardState.value[index], 0))
        .find(sum => Math.abs(sum) === 3);

    // handle O win
    if (winningLines === 3) {
        Swal.fire("O has won the game");
        boardState.value.fill(0);
        return
    }

    // handle x win
    if (winningLines === -3) {
        boardState.value.fill(0);
        Swal.fire("X has won the game");
        return
    }

    // handle match tie condition
    if (!boardState.value.includes(0)) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "It's a tie",
        });
    }
}

</script>
