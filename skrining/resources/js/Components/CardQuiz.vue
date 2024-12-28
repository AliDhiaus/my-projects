<script setup>
import { dataquiz } from '@/lib/dataquiz';
import { useForm } from '@inertiajs/vue3';
import { ref, reactive, defineEmits } from 'vue';

const emit = defineEmits(['submitted']);


const props = defineProps({
  nikUser: {
    type: String,
    default: '0',
  }
});

// Initialize form with answers as an object and nik from props
const form = useForm({
  answers: reactive({}),  // Using reactive to handle nested objects
  nik: props.nikUser || '',
});

// Initialize answers structure based on dataquiz
function initializeAnswers() {
  dataquiz.forEach(item => {
    form.answers[item.id] = {};
    item.quisioner.forEach(quiz => {
      form.answers[item.id][quiz.id] = '';  
    });
  });
}

initializeAnswers();

function handleSubmit() {
  form.post(route('home.insertQuiz'), {
    onSuccess: () => {
      console.log('Form submitted successfully');
      emit('submitted', 'ipwl'); 
    },
    onError: (errors) => {
      console.error(errors);
    },
  });
}
</script>

<template>
  <form @submit.prevent="handleSubmit" class="flex flex-col gap-2 w-full shadow p-5">
    <div v-for="(item, index) in dataquiz" :key="index">
      <div class="p-2 text-white text-center bg-gradient-to-r from-green-500 to-blue-500">
        <h1>Pertanyaan Quesioner {{ index + 1 }}</h1>
      </div>
      <div class="my-5">
        <h1>{{ index + 1 }} . {{ item.name }}</h1>
        <div class="my-2" v-for="(quiz, quizIndex) in item.quisioner" :key="quizIndex">
          <p class="my-4" v-if="quiz.name">{{ `${quiz.id}. ${quiz.name}` }}</p>
          <div class="flex gap-2 items-center mb-2" v-for="(value, valueIndex) in quiz.value" :key="valueIndex">
            <input
              type="radio"
              :name="`quiz_${item.id}_${quiz.id}`"
              :value="value"
              :id="`${item.id}-${quiz.id}-${value}`"
              v-model="form.answers[item.id][quiz.id]"
              class="text-slate-700"
            />
            <label :for="`${item.id}-${quiz.id}-${value}`">{{ value }}</label>
          </div>
        </div>
      </div>
    </div>
    <div class="flex justify-center mt-5">
      <button type="submit" class="bg-blue-500 p-2 text-white w-1/5 rounded">Submit</button>
    </div>
  </form>
</template>
