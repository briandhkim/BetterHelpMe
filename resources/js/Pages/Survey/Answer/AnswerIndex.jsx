import SurveyLayout from '@/Layouts/SurveyLayout';
import { useForm } from '@inertiajs/react';
import { useEffect } from 'react';
import RadioQuestion from './Partial/RadioQuestion';
import CheckboxQuestion from './Partial/CheckboxQuestion';
import { classNames } from '@/Utils/helpers';
import { API_V1 } from '@/Utils/constants';

const AnswerIndex = ({ pageTitle, survey }) => {
	const { questions } = survey;

	const { data, setData, post, processing, errors, isDirty } = useForm({});

	useEffect(() => {
		// console.log(questions);
		if (questions.length) {
			questions.map(question => {
				if (!data.hasOwnProperty(`question_${question.id}`)) {
					setData(prevData => ({
						...prevData,
						[`question_${question.id}`]: [],
					}));
				}
			});
		}
	}, [questions]);

	useEffect(() => {
		// console.log(data);
	}, [data]);

	const handleSubmit = e => {
		e.preventDefault();
		// console.log(data);
		post(`${API_V1}/surveys/${survey.id}/responses`);
	};

	return (
		<SurveyLayout pageTitle={pageTitle}>
			<div className=''>
				<h2 className=' text-2xl font-extrabold font-mono'>
					Answer the following questions
				</h2>
			</div>
			<form onSubmit={handleSubmit}>
				<div className='mt-6 space-y-2 divide-y-2'>
					{questions.map(question => (
						<div key={question.id} className='py-6'>
							{question.type === 'radio' ? (
								<RadioQuestion
									question={question}
									data={data}
									setData={setData}
								/>
							) : (
								<CheckboxQuestion
									question={question}
									setData={setData}
								/>
							)}
							{errors[`question_${question.id}`] && (
								<div className='mt-4 pl-2 text-red-500'>
									{errors[`question_${question.id}`]}
								</div>
							)}
						</div>
					))}
					<div className='pt-10'>
						<button
							type='submit'
							className={classNames(
								isDirty
									? 'bg-indigo-600 hover:bg-indigo-500'
									: 'bg-neutral-500',
								'rounded-md px-3 py-2 text-sm font-semibold text-white shadow-sm  focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600'
							)}
							disabled={processing}
						>
							Submit
						</button>
					</div>
				</div>
			</form>
		</SurveyLayout>
	);
};

export default AnswerIndex;
